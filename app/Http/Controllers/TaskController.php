<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        return view('admin.tasks.index', ['tasks' => Task::all()]);
    }

    public function create()
    {   
        $projects = Project::all();
        $users = User::where('role', 'user')->get();
        return view('admin.tasks.create', compact('projects', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'nullable|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'nullable|in:Pending,In Progress,Completed',
            'completed_at' => 'nullable|date',
        ]);

        $task = Task::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'status' => $validatedData['status'] ?? 'Pending',
            'project_id' => $validatedData['project_id'],
            'assigned_to' => $validatedData['assigned_to'],
            'completed_at' => $validatedData['completed_at'],
            
        ]);

        return redirect()->route('admin.tasks')->with('success', 'Task created successfully!');
    }

    public function show($id)
    {
        $task = Task::with('project', 'assignedUser')->findOrFail($id);

        return view('admin.tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();
        $users = User::where('role', 'user')->get();
        return view('admin.tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'assigned_to' => 'nullable|exists:users,id',
            'project_id' => 'nullable|exists:projects,id',
            'completed_at' => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('admin.tasks')->with('success', 'Task updated successfully!');
        
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return back()->with('success', 'Task deleted successfully!');
    }
}   
