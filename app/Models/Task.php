<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;
// use Spatie\Activitylog\LogOptions;



class Task extends Model
{
    use HasFactory; 
    // use LogsActivity;
    


    protected $fillable =[
        'projectname',
        'todo',
        'type',
        'deadline',
        'assignedDate',
        'status',
        'porjct_id'
    
        
    ];
    public function project()
    {
        return $this->belongsTo(Projectt::class,'porejct_id');
    }
    public function Report()
        {
            return $this->hasOne(Report::class);
        }
        public function user()
    {
        return $this->belongsTo(USER::class,'user_id');
    }
        // public function getActivitylogOptions(): LogOptions
        // {
        //     return LogOptions::defaults()
        //         ->logOnly(['status', 'projectname']) // specify the attributes you want to log
        //         ->dontSubmitEmptyLogs();
        // }
         

    
   
}
