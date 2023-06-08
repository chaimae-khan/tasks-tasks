<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectt extends Model
{
 

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
   
     
}
