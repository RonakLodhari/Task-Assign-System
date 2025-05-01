<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function projects()
    {   
        $projects = \App\Models\Project::all();
        return view('admin.reports.projects',compact('projects'));
    }

    public function tasks()
    {
        $tasks = \App\Models\Task::all();
        return view('admin.reports.tasks',compact('tasks'));
    }

    public function users()
{
    $users = \App\Models\User::all(); 
    return view('admin.reports.users', compact('users'));
}

}
