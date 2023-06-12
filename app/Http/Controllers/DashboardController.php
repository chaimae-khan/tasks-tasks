<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Projectt;
use App\Models\Task;
class DashboardController extends Controller
{
    public function index()
    {
        return view('Dashboard');
    }
    
    public function countAdmin(){

        $adminCount  = User::where('is_admin', true)->count();
        $memberCount = User::where('is_admin', false)->count();
        $report      = Report::count();
        $project     = Projectt::count();
        $tasks       = Task ::where('operation','=','Dis')->count();

        return view('Dashboard', compact('adminCount', 'memberCount','report','project','tasks'));

    }
   

}
