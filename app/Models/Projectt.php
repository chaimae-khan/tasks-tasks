<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class Projectt extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = ['name_project', 'Descrption'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name_project', 'Descrption']) // specify the attributes you want to log
            ->dontSubmitEmptyLogs();
    }
     
}
