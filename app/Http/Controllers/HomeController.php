<?php

namespace App\Http\Controllers;
use DB ;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Task ;
use App\Models\Employee ;
use App\Models\Rapport;
use Illuminate\Http\Request;
use App\Models\EmployeeTask ;
use App\Models\Projectt;
use App\Models\Report;
use App\Notifications\NewTaskNotification;
/* use Illuminate\Notifications\Notification; */

use Illuminate\Support\Facades\Notification;

use function GuzzleHttp\Promise\task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        
        $is_admin = Auth::user()->is_admin;
        
        $tasks = DB::table('tasks')
        ->join('employee_task','employee_task.task_id','=','tasks.id')
        ->join('employees','employees.id','=','employee_task.employee_id')
        ->join('projectts','projectts.id','=','tasks.projct_id')
        ->select('tasks.*','employees.name','employee_task.assigned_date','projectts.name_project')
        ->where('tasks.operation','=','dis')
        ->whereNotIn('tasks.id',function($query){
            $query->select('task_id')->from('reports');})
        ->get();
     

        $emp = Employee::all();
        $project= Projectt::all();
        $statutTask = ['Open','Delivred','To Do','To Test','Colosed','Cancled'];
        $PriorityTask = ['low ','not critical','normal','uregent'];

        return view('admin')
        ->with('tasks',$tasks)
        ->with('emp',$emp)
        ->with('project',$project)
        ->with('statutTask',$statutTask)
        ->with('PriorityTask',$PriorityTask)
        ->with('is_admin',$is_admin);
       
    }
    public function getEmployees(Request $request)
    {
        $this->authorize("task.getemployee");
        $employees = Employee::where('id', $request->id)->pluck('name', 'id');
        return response()->json($employees);
    }
    public function store(Request $request)
    {
        
         
   $employee = Employee::firstOrCreate([
    'name' => $request->employee
    ]);
   


    $projectName = $request->input('project_name');
    $project = Projectt::where('name_project', $projectName)->first();
    
        $task = Task::with('project')->get();
        $task = new Task();
        $this->authorize("task.create",$task);
        $task->projectname = $request->input('projectname');
        $task->todo = $request->input('todo');
        $task->type = $request->input('type');
        $task->projct_id =$request->projct_id;
        $task->operation = 'Dis'; 
        $task->status = $request->input('status') ;
    
       
    
        $task->deadline = $request->input('deadline');
        $task->history =' #'.'work on it '.$request->employee.' date created task '.Carbon::now();
        $task->save();
       
       
       
        $employeeTask = new EmployeeTask();
        $employeeTask->employee_id = $employee->id;
        $employeeTask->task_id = $task->id;
        $employeeTask->assigned_date = $request->input('assigned_date');
        $employeeTask->save();

        $employee = Employee::find($employee->id);
        $name = $employee->name;
        $userName = Auth::user()->name;
        $Users = User::where('id','!=',Auth::user()->id)->get();
        $create_task = Auth::user()->name;
        $todo = $task->todo ;

        
        if(strcmp($userName , $name))
        {
           
            Notification::send($Users, new NewTaskNotification($task->id,$create_task,$todo));
            

        }
        else
        {
            return response()->json([
                'statut'    =>400,
            ]);
        }
         activity()
        ->causedBy(auth()->user())
        ->performedOn($task)
        ->withProperties([
            'attributes' => [
                'projectname '=>$request->input('projectname'),
                'todo'        => $request->input('todo'),
                'type'        => $request->input('type'),
                'status'      => $request->input('status'),
                'deadline'   =>$request->input('deadline'),
                'assigned_date'=>$request->input('assigned_date'),
                'employee'=> $request->employee,

            ],
        ])
        ->event('created')
        ->log('Task created');
      
        
    
        return response()->json(['success' => true]);
    }
    public function destroy($id)
{
    activity()
    ->causedBy(auth()->user())
    ->withProperties([
        'id' => $id,
       
    ])
    ->event('delete')
    ->log('task deleted');
        $this->authorize("task.delete");
        $task =Task::whereId($id)->update([
         'operation'=>'D'
        ]);
     
        return redirect()->back();
    }
    public function subEmp(Request $request)
    {
         
        $employees = Employee::firstOrCreate([
            'name' => $request->input('employee')
        ]);
        return response()->json([
            'employees' => $employees
        ]);
    }

    public function getHistory(Request $request)
    {
       
        $history = Task::where('id','=',$request->id)->select('history')->get();
        $this->authorize("task.history");
        $arrayhistory = [];
        foreach($history as $item)
        {
            array_push($arrayhistory,$item->history);
        }
        $arrayhistory = implode('#', $arrayhistory);
        $explodeArray = explode('#',$arrayhistory);
        $explodeArray = array_filter($explodeArray);
         return response()->json([
            'statut'=> 200,
            'Datahistory'=>$explodeArray,
         ]);
    }

    public function getTask(Request $request)
    {
        $tasks = DB::table('tasks')
        ->join('employee_task','employee_task.task_id','=','tasks.id')
        ->join('employees','employees.id','=','employee_task.employee_id')
        ->select('tasks.*','employees.name',DB::raw('date(employee_task.assigned_date) as assigned_date'),DB::raw('date(tasks.deadline) as deadline'))
        ->where('tasks.operation','=','dis')
        ->where('tasks.id','=',$request->idtask)
        ->get();
     
       
        return response()->json([
            'statut'            =>200,
            'data'              =>$tasks,
        ]);
       
    }

    public function updateTask(Request $request)
    {
        
        $task = Task :: findOrFail($request->id);
        $employee_task = DB::select("select employee_id from employee_task where task_id =?",[$request->id]);
        
        $employee = Employee ::findOrFail($employee_task[0]->employee_id);
        //  dd($employee->name);
        activity()
        ->causedBy(auth()->user())
        ->performedOn($task,$employee)
        ->withProperties([
            'old' => [
                'Priority' => $task->projectname,
                'todo'     => $task->todo ,
                'type'     => $task->type ,
                'emplyee'  => $employee->name,
                'status'   => $task->status,
               'deadline'  => $task->deadline,

                            

            ],
            'attributes' => [
            'Priority'       =>$request->input('PName'),
            'todo'           =>$request->input('Todo'),
            'type'           =>$request->input('Type'),
            'deadline'       =>$request->input('Deadline'),
            'status'         =>$request->input('Statuts'),
            'employee'       =>$request->input('Employe'),
       

            ],
        ])
        ->event('update')
        ->log('Task updated');

      
        
        $task  = Task::where('id','=',$request->id)->update([
            'projectname'                   =>$request->PName,
            'todo'                          =>$request->Todo,
            'type'                          =>$request->Type,
            'deadline'                      =>$request->Deadline,
            'status'                        =>$request->Statuts,
        ]);
        
        $employee = DB::select("select id from employees where name = ?", [$request->Employe]);
        $employee_task = DB::select("select id from employee_task where task_id =?",[$request->id]);

        $UpdateEmployeeTask = EmployeeTask::where('id','=',$employee_task[0]->id)->update([
            'assigned_date'     => $request->ADate,
            'employee_id'       => $employee[0]->id,
            
        ]);
        

       

       

        $status='Delivred';
        $ReportTasks  = Task::where('status','=',$status)->get();
       

        foreach ($ReportTasks as $ReportTask) {
            if (strcmp($ReportTask->status, 'Delivered') !== 0 && $ReportTask->id == $request->id) {
                $report = new Report();
                $report->projectname = $ReportTask->projectname;
                $report->todo = $ReportTask->todo;
                $report->type = $ReportTask->type;
                $report->deadline = $ReportTask->deadline;
                $report->status = $ReportTask->status;
        
                $ReportTask->report()->save($report);
            }
        }
        





 

     return response()->json([
            'statut'            =>200,
        ]);



    }
   
  

}

