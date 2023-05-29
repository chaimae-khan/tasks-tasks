<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    use HasFactory; 
    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withPivot('assigned_date');
    }


    protected $fillable =[
        'projectname',
        'todo',
        'type',
        'deadline',
        'status',
        'porjct_id'
    
        
    ];
    public function project()
    {
        return $this->belongsTo(Projectt::class,'porejct_id');
    }
    public function rapport()
    {
        return $this->hasOne(Rapport::class);
    }

    
   
}
