<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // These fields are mass assignable
    protected $fillable = [
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
    ];

    // Dates that should be mutated to instances of Carbon
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationship with tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Many-to-many relationship with users
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    // Calculate the progress of the project
    public function calculateProgress()
    {
        // Get the related tasks
        $tasks = $this->tasks;

        // If no tasks are assigned, return 0
        if ($tasks->isEmpty()) {
            return 0;
        }

        // Count completed tasks and total tasks
        $completedTasks = $tasks->where('status', 'Completed')->count();
        $totalTasks = $tasks->count();

        // Calculate and return the percentage
        return round(($completedTasks / $totalTasks) * 100);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
}
