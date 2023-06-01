<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ReportController extends Controller
{ public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

    $is_admin = Auth::user()->is_admin;
    $Reports = Report::latest()->paginate(5);

    return view('Reports',compact('Reports'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
}

}
