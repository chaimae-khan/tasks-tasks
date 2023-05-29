<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;
    protected $table = 'rapport';

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
