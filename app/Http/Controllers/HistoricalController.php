<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Spatie\Activitylog\Models\Activity ;
use App\Models\User;
class HistoricalController extends Controller
{
    
    public function index()
    {
        $logs = Activity::all();
        $users = User::all();
        return view('historical', compact('logs'))->with('users',$users); 
    }
}
