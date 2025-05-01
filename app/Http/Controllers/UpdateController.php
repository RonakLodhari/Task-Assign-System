<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Update;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function index()
    {
        $updates = Update::where('user_id', Auth::id())->get();
        return view('updates.index', compact('updates'));
    }
    public function adminIndex()
    {
        $updates = Update::with('user')->get(); 
        return view('admin.updates.index', compact('updates'));
    }

    public function destroy(Update $update)
    {
        $update->delete();
        return redirect()->route('admin.updates.index')->with('success', 'Update deleted successfully!');
    }

    public function create()
    {
        $projects = \App\Models\Project::all();
        $tasks = \App\Models\Task::all();

        return view('updates.create', compact('projects', 'tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'project_id' => 'nullable|exists:projects,id',
            'task_id' => 'nullable|exists:tasks,id',
            'status' => 'required|in:Pending,Reviewed,Rejected',
            'other' => 'nullable|string',
        ]);
    
        Update::create([
            'user_id' => Auth::id(),
            'project_id' => $request->project_id,
            'task_id' => $request->task_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'other' => $request->other,
        ]);
    
        return redirect()->route('user.updates.index')->with('success', 'Update submitted successfully!');
    }
    
    public function edit(Update $update)
    {
        $projects = \App\Models\Project::all();
        $tasks = \App\Models\Task::all();

        return view('updates.edit', compact('update', 'projects', 'tasks'));
    }
    public function show(Update $update)
    {
        return view('updates.show', compact('update'));
    }

    public function update(Request $request, Update $update)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required|in:Pending,Reviewed,Rejected',
            'other' => 'nullable|string',
        ]);

        $update->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'other' => $request->other,
        ]);

        return redirect()->route('user.updates.index')->with('success', 'Update edited successfully!');
    }

    public function updateStatus(Request $request, Update $update)
    {
        $request->validate([
            'status' => 'required|in:Pending,Reviewed,Rejected',
        ]);

        $update->update(['status' => $request->status]);

        return redirect()->route('admin.updates.index')->with('success', 'Status updated successfully!');
    }
}
