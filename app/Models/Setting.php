<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'email_notifications',
        'task_reminders',
        'project_updates',
        'two_factor_auth',
        'login_notification'
    ];

    protected $casts = [
        'email_notifications' => 'boolean',
        'task_reminders' => 'boolean',
        'project_updates' => 'boolean',
        'two_factor_auth' => 'boolean',
        'login_notification' => 'boolean',
    ];
}