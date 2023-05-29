<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Projectt;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

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
        $project->name = $request->input('name');
        $project->Descrption = $request->input('Descrption');
        $project->save();
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
        $project->delete();
        return redirect()->back();
    }

    public function UpdateProjet(Request $request)
    {
        
        $updatProjet = Projectt::where('id','=',$request->id)->update([
            'name'          => $request->name,
            'Descrption'       =>$request->desc,
        ]);
        return response()->json([
            'statut'            =>200,
        ]);
    }
    
    
}
