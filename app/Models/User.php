<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'dob',
        'phone',
        'address',
        'role',
        'usertype',
        'frontend_languages',
        'backend_languages',
        'image',
        'login_time',
        'logout_time'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'frontend_languages' => 'array',
        'backend_languages' => 'array',
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'assigned_to');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
    public function assignedProjects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id');
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
}
