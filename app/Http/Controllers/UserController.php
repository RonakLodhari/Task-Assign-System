<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard', [
            'projects' => $user->assignedProjects()->get(),
            'tasks' => Task::where('assigned_user_id', $user->id)->get(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'dob' => 'date',
            'phone' => 'string|max:15',
            'address' => 'string',
            'role' => ['required', Rule::in(['admin', 'user'])],
            'usertype' => ['nullable', Rule::in(['employee', 'manager', 'SEO', 'frontend developer', 'backend developer'])],
            'frontend_languages' => 'nullable|array',
            'backend_languages' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'login_time' => 'date',
            'logout_time' =>'date',
        ]);

        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->usertype = $request->usertype;

        $user->frontend_languages = $request->usertype === 'frontend developer' ? json_encode($request->frontend_languages) : null;
        $user->backend_languages = $request->usertype === 'backend developer' ? json_encode($request->backend_languages) : null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/users'), $imageName);
            $user->image = 'uploads/users/' . $imageName;
        }
        $user->login_time = $request->login_time;
        $user->logout_time = $request->logout_time;

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
        'password' => 'nullable|min:6', // Make password optional
        'dob' => 'date',
        'phone' => 'string|max:15',
        'address' => 'string',
        'role' => ['required', Rule::in(['admin', 'user'])],
        'usertype' => ['nullable', Rule::in(['employee', 'manager', 'SEO', 'frontend developer', 'backend developer'])],
        'frontend_languages' => 'nullable|array',
        'backend_languages' => 'nullable|array',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'login_time' => 'nullable|date',
        'logout_time' => 'nullable|date',
    ]);

    $user->fullname = $request->fullname;
    $user->email = $request->email;
    $user->dob = $request->dob;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->role = $request->role;
    $user->usertype = $request->usertype;

    // Update password only if a new password is provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->frontend_languages = $request->usertype === 'frontend developer' 
        ? json_encode($request->frontend_languages) : null;

    $user->backend_languages = $request->usertype === 'backend developer' 
        ? json_encode($request->backend_languages) : null;

    // Handle image upload and delete old image
    if ($request->hasFile('image')) {
        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/users'), $imageName);
        $user->image = 'uploads/users/' . $imageName;
    }

    $user->login_time = $request->login_time;
    $user->logout_time = $request->logout_time;

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
}


    public function create()
    {
        return view('admin.users.create');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    public function viewTasks()
    {
        $tasks = Task::where('assigned_user_id', auth()->id())
            ->orderBy('created_at', 'desc') // Newest first
            ->get();
    
        return view('user.tasks', compact('tasks'));
    }

    public function viewProjects()
    {
        $user = auth()->user();
        $projects = $user->assignedProjects()->with('assignedUsers')->latest()->get();
        return view('user.projects', compact('projects'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        $projects = $user->assignedProjects()->get();
        $tasks = Task::where('assigned_user_id', $id)->get();
    
        return view('admin.users.show', compact('user', 'projects', 'tasks'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function submitTimesheet(Request $request)
    {
        return back()->with('success', 'Timesheet submitted successfully.');
    }
    public function fetchNotifications()
    {
        $notifications = [
            ['message' => 'Admin assigned you a new project!'],
            ['message' => 'Project deadline updated.'],
        ];

        return response()->json(['notifications' => $notifications]);
    }
}
