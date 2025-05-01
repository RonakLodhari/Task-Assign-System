<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'status', 'assigned_to', 'completed_at', 'action', 'project_id'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'status' => 'string',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deadline'
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
