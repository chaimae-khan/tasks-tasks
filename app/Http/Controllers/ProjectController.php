<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Projectt;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Spatie\Activitylog\Models\Activity;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $is_admin = Auth::user()->is_admin;
        $projectts = Projectt::latest()->paginate(5);
  
        return view('projet',compact('projectts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projectts.create');
    }

    /**
     * Store a newly created resource in storage.
     */

  

        public function getproject(Request $request)
        {     
    
           
               $projectts = DB::table('projectts')
                ->where('id', $request->idprojet)
                ->get();
                
              
            return response()->json([
                'statut' => 200,
                'data' => $projectts,
            ]);
        }
        


     
   
    public function store(Request $request)
    {
      
        $project = new Projectt();
        $project->name_project = $request->input('name_project');
        $project->Descrption = $request->input('Descrption');
        $project->save();
        activity()
        ->causedBy(auth()->user())
        ->performedOn($project)
        ->withProperties([
            'attributes' => [
                'name_project' => $request->input('name_project'),
                'Descrption' => $request->input('Descrption'),
            ],
        ])
        ->event('created')
        ->log('user created');
        return response()->json(['success' => true]);
        
    }

    

   
    public function show(Projectt $projectt)
    {
        return view('projectts.show',compact('projectt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       
            return view('projectts.edit',compact('projectt'));
        }
    

    /**
     * Update the specified resource in storage.
     */
  
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $project = Projectt::findOrFail($id);
        activity()
        ->causedBy(auth()->user())
        ->performedOn( $project)
        ->withProperties([
            'old' => [
                'name' =>  $project->name_project,
                'Descrption' =>  $project->Descrption,
            ]
            
        ])
        ->event('deleted')
        ->log('Project deleted');
        $project->delete();
        return redirect()->back();
    }

    public function UpdateProjet(Request $request)
    {
        $project = Projectt :: findOrFail($request->id);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($project)
        ->withProperties([
            'old' => [
                'name_project' => $project->name_project,
                'Descrption' => $project->Descrption,
            ],
            'attributes' => [
                'name_project' => $request->input('name_project'),
                'Descrption' => $request->input('desc'),
            ],
        ])
        ->event('update')
        ->log('project updated');

     
        $updatProjet = Projectt::where('id','=',$request->id)->update([
            'name_project'          => $request->name_project,
            'Descrption'            =>$request->desc,
        ]);
        return response()->json([
            'statut'            =>200,
        ]);
      
       
    }
    
    
}
