<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;
// use Spatie\Activitylog\LogOptions;

class EmployeeTask extends Model
{
    use HasFactory;
    // use LogsActivity;

    protected $table = 'employee_task';

    protected $fillable = [
        'id',
        'employee_id',
        'task_id',
        'assigned_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logOnly(['assigned_date']) // specify the attributes you want to log
    //         ->logOnly(['assigned_date'])
    //         ->dontSubmitEmptyLogs();
    // }
   
}
