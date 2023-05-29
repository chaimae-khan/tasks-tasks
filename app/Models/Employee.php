<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
   
    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('assigned_date');
    }

    protected $fillable = [
        'name',
    ];
  
  

   
}
