<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('assignedUsers')->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get(); 
        return view('admin.projects.create', compact('users'));
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', [
            'project' => $project->load('assignedUsers'),
            'tasks' => $project->tasks()->with('assignedUser')->latest()->get(),
            'progress' => $project->calculateProgress(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'assigned_to' => 'nullable|array',
            'assigned_to.*' => 'exists:users,id',
            'end_date' => 'nullable|date', // <-- Added validation for end_date
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => now(),
            'end_date' => $request->end_date, // <-- Save end_date
        ]);

        $project->assignedUsers()->sync($request->assigned_to);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit($id)
    {
        $project = Project::with('assignedUsers')->findOrFail($id);
        $users = User::where('role', 'user')->get();
        return view('admin.projects.edit', compact('project', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'assigned_to' => 'nullable|array',
            'assigned_to.*' => 'exists:users,id',
            'end_date' => 'nullable|date', // <-- Added validation for end_date
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'end_date' => $request->end_date, // <-- Update end_date
        ]);

        $project->assignedUsers()->sync($request->assigned_to);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->tasks()->delete(); 
        $project->assignedUsers()->detach();
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }

    public function adminIndex()
    {
        $projects = Project::with(['assignedUsers', 'tasks'])->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }
}
