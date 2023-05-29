<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index()
    {
       
        // $users = User::all();
        $users = DB::table('users')
        ->select('users.*')
        ->where('users.is_admin','=','0')
        ->get();
        return view('auth.Registerdisplay', compact('users'));
    }

    public function showRegistrationForm()
{
    return view('auth.register');
}
public function registerUser(Request $request)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone_number' => 'required|string|max:255',
        'picture' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'skills' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Create a new user record
    $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone_number' => $request->input('phone_number'),
        'picture' => $request->input('picture'),
        'status' => $request->input('status'),
        'skills' => $request->input('skills'),
        'password' => Hash::make($request->input('password')),
    ]);
    $user->save();
    
    $employee = new Employee(['name'=>$user->name]);
   
    return redirect('/home');
}
public function destroy($id)
{
    
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->back()->with('success', 'Item deleted successfully.');


}
public function getuser(Request $request)
{     

   
       $user = DB::table('users')
        ->where('id', $request->iduser)
        ->get();
        
      
    return response()->json([
        'statut' => 200,
        'data' => $user,
    ]);
}
public function updateUser(Request $request)
{
 
    $updateUser = User::where('id', $request->id)->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone_number' => $request->input('phone_number'),
        'picture' => $request->input('picture'),
        'status' => $request->input('status'),
        'skills' => $request->input('skills'),
        // 'password' => Hash::make($request->input('password'))
    ]);
    
    return response()->json([
        'status' => 200,
    ]);
}


}