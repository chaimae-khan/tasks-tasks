<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\Event\Code\Test;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use Spatie\Activitylog\Models\Activity;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    // return Activity::all();
    return view('welcome');
});

Auth::routes();
Route::get('/historical', [App\Http\Controllers\HistoricalController::class, 'index']);
Route::get('/Profile', [App\Http\Controllers\AdminController::class, 'profile']);
Route::get('/home', [App\Http\Controllers\AdminController::class, 'index']);
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('tasks.index');
Route::get('/register', [App\Http\Controllers\RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\RegistrationController::class, 'registerUser'])->name('register.user');
Route::get('/test', [App\Http\Controllers\RegistrationController::class, 'index']);
Route::delete('/test/{id}', [App\Http\Controllers\RegistrationController::class, 'destroy'])->name('register.destroy');
Route::get('/Reports', [App\Http\Controllers\ReportController::class, 'index']);

Route::get('getTask',[HomeController::class,'getTask']);
Route::get('UpdateProjet',[ProjectController::class,'UpdateProjet']);
Route::get('getproject',[ProjectController::class,'getproject']);
Route::get('updateUser',[App\Http\Controllers\RegistrationController::class,'updateUser']);
Route::get('getuser',[App\Http\Controllers\RegistrationController::class,'getuser']);
Route::get('updateTask',[HomeController::class,'updateTask']);
Route::post('store',[ProjectController::class,'store']);

Route::delete('/project/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('project.destroy');
Route::middleware('admin')->group(function () {
    Route::post('/admin', [App\Http\Controllers\HomeController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('tasks.destroy');
    Route::get('employees/{id}', [App\Http\Controllers\HomeController::class, 'getEmployees'])->name('employees.getEmployees');
    Route::get('getHistory',[App\Http\Controllers\HomeController::class,'getHistory']);
    Route::resource('projects', ProjectController::class);
    
   
  
});

