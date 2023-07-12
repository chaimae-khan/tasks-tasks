<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;
// use Spatie\Activitylog\Traits\LogsActivity;
// use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    
    use HasApiTokens, HasFactory, Notifiable;
    use HasApiTokens;
    use HasFactory;
    // use LogsActivity;
    use Notifiable;
    // use Loggable;
    // protected static $recordEvents=['created','updated','deleted'];

    // protected static $logAttributes =['name','email'];



    public function isAdmin()
    {
        return $this->is_admin === 1; 
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'picture' ,
        'status',
        'skills',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getPictureAttribute($value){
        if($value){
            return asset('users/images/'.$value);
        }else{
            return asset('users/images/no-image.png');
        }
    }
    
    public function delete()
    {
        // Perform any additional actions or checks before deleting the user

        // Delete the user
        parent::delete();

        // Perform any additional actions after deleting the user
    }
   
    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
           
    //         ->logOnly(['name', 'email'])
    //         ->logFillable()
    //         ->logOnlyDirty()
    //         ->dontSubmitEmptyLogs();
    // }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
   
     }

