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
        $user_id  = Auth::user()->id;
       
       
        $tasks = DB::table('tasks')
        ->join('projectts','projectts.id','=','tasks.projct_id')
        ->join('users','users.id','=','tasks.user_id')
        ->select('tasks.*','projectts.name_project','users.name')
        ->where('tasks.operation','=','dis')
        ->where(function($query) use ($is_admin,$user_id){
            if($is_admin == 0)
            {
                $query->where('tasks.user_id',$user_id);
            }
        })
        ->whereNotIn('tasks.id',function($query){
            $query->select('task_id')->from('reports');})
        ->get();
        
     

        $user = User::all();
        $project= Projectt::all();
        $statutTask = ['Open','Delivred','To Do','To Test','Colosed','Cancled'];
        $PriorityTask = ['low ','not critical','normal','uregent'];
        $emp = DB::select('select * from users');//samya table
        return view('Admin')
        ->with('tasks',$tasks)
        ->with('project',$project)
        ->with('statutTask',$statutTask)
        ->with('PriorityTask',$PriorityTask)
        ->with('is_admin',$is_admin)
        ->with('user',$user)
        ->with('emp',$emp);

    }
    // public function getEmployees(Request $request)
    // {
    //     $this->authorize("task.getemployee");
    //     $employees = Employee::where('id', $request->id)->pluck('name', 'id');
    //     return response()->json($employees);
    // }
    public function store(Request $request)
    {
        
         
//    $employee = Employee::firstOrCreate([
//     'name' => $request->employee
//     ]);
   


    $projectName = $request->input('project_name');
    $project = Projectt::where('name_project', $projectName)->first();
    $userName = $request->input('user_name');
    $user = User::where('name', $userName)->first();
    
        $task = Task::with('project')->get();
        $task = new Task();
        $this->authorize("task.create",$task);
        $task->priority = $request->input('priority');
        $task->todo = $request->input('todo');
        $task->type = $request->input('type');
        $task->projct_id =$request->projct_id;
        $task->user_id =$request->user_id;
        $task->operation = 'Dis'; 
        $task->status = $request->input('status') ;
    
       
        $task->deadline = $request->input('deadline');
        $task->assignedDate= $request->input('assignedDate');
        $task->history =' #'.'work on it '.$request->employee.' date created task '.Carbon::now();
        $task->save();
       
       
       
        // $employeeTask = new EmployeeTask();
        // $employeeTask->employee_id = $employee->id;
        // $employeeTask->task_id = $task->id;
        // $employeeTask->assigned_date = $request->input('assigned_date');
        // $employeeTask->save();

        // $employee = Employee::find($employee->id);
        // $name = $employee->name;
        $userName = Auth::user()->name;
        $Users = User::where('id','!=',Auth::user()->id)->get();
        $create_task = Auth::user()->name;
        $todo = $task->todo ;

            Notification::send($Users, new NewTaskNotification($task->id,$create_task,$todo));
            

      
         activity()
        ->causedBy(auth()->user())
        ->performedOn($task)
        ->withProperties([
            'attributes' => [
                'priority'    =>$request->input('priority'),
                'todo'        => $request->input('todo'),
                'type'        => $request->input('type'),
                'status'      => $request->input('status'),
                'deadline'   =>$request->input('deadline'),
                'assignedDate'=>$request->input('assignedDate'),
                'user_name'=> $request->user_name,

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
    // public function subEmp(Request $request)
    // {
         
    //     $employees = Employee::firstOrCreate([
    //         'name' => $request->input('employee')
    //     ]);
    //     return response()->json([
    //         'employees' => $employees
    //     ]);
    // }

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
        ->join('projectts','projectts.id','=','tasks.projct_id')
        ->join('users','users.id','=','tasks.user_id')
        ->select('tasks.*','projectts.name_project','users.name',DB::raw('date(tasks.assignedDate) as assignedDate'),DB::raw('date(tasks.deadline) as deadline'))
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
        $employee_task = DB::select("select user_id from tasks where id =?",[$request->id]);
        $employee = User ::findOrFail($employee_task[0]->user_id);
        
        activity()
        ->causedBy(auth()->user())
        ->performedOn($task,$employee)
        ->withProperties([
            'old' => [
                'Priority' => $task->priority,
                'todo'     => $task->todo ,
                'type'     => $task->type ,
                'emplyee'  => $employee->name,
                'status'   => $task->status,
               'deadline'  => $task->deadline,

                            

            ],
            'attributes' => [
            'priority'       =>$request->input('priority'),
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
            'priority'                      =>$request->priority,
            'todo'                          =>$request->Todo,
            'type'                          =>$request->Type,
            'deadline'                      =>$request->Deadline,
            'assignedDate'                  =>$request->ADate,
            'status'                        =>$request->Statuts,
        ]);
        
         
       
        $employee = DB::select("select id from users  where id = ?", [$request->Employe]);
        
        $UpdateEmployeeTask = Task::where('id','=',$request->id)->update([
        // //     'assigned_date'     => $request->ADate,
                'user_id'       => $employee[0]->id
            
         ]);
        

       

       

        $status='Delivred';
        $ReportTasks  = Task::where('status','=',$status)->get();
       

        foreach ($ReportTasks as $ReportTask) {
            if (strcmp($ReportTask->status, 'Delivered') !== 0 && $ReportTask->id == $request->id) {
                $report = new Report();
                $report->projectname = $ReportTask->priority;
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

