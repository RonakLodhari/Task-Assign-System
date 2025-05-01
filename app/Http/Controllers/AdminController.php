<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting; // Add this import at the top
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProjects = Project::count();
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'Completed')->count();

        $taskStatusData = [
            'Pending' => Task::where('status', 'Pending')->count(),
            'In Progress' => Task::where('status', 'In Progress')->count(),
            'Completed' => Task::where('status', 'Completed')->count()
        ];

        $projectStatusData = [
            'Pending' => Project::where('status', 'Pending')->count(),
            'In Progress' => Project::where('status', 'In Progress')->count(),
            'Completed' => Project::where('status', 'Completed')->count()
        ];

        $recentProjects = Project::latest()->limit(5)->get();
        $recentTasks = Task::latest()->limit(5)->get();

        $recentLogins = User::orderBy('login_time', 'desc')->limit(5)->get(['fullname', 'login_time']);

        $userRolesCount = User::selectRaw('usertype, COUNT(*) as count')
            ->groupBy('usertype')
            ->pluck('count', 'usertype');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProjects',
            'totalTasks',
            'completedTasks',
            'recentProjects',
            'recentTasks',
            'taskStatusData',
            'projectStatusData',
            'recentLogins',
            'userRolesCount'
        ));
    }

    public function listUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function settings()
    {
        $settings = Setting::first();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = Setting::first() ?? new Setting();
        
        $settings->company_name = $request->company_name;
        $settings->company_email = $request->company_email;
        $settings->company_phone = $request->company_phone;
        $settings->email_notifications = $request->has('email_notifications');
        $settings->task_reminders = $request->has('task_reminders');
        $settings->project_updates = $request->has('project_updates');
        $settings->two_factor_auth = $request->has('two_factor_auth');
        $settings->login_notification = $request->has('login_notification');
        
        $settings->save();

        return back()->with('success', 'Settings updated successfully');
    }
    
    public function logs()
    {
        $users = User::select('id','image','fullname', 'login_time', 'logout_time')
            ->orderBy('login_time', 'desc')
            ->get();
        
        $projects = Project::select('id', 'title', 'status', 'assigned_to')
            ->with('assignedUser:id,fullname')
            ->orderBy('id', 'desc')
            ->get();
        
        $tasks = Task::select('id', 'name', 'status', 'assigned_to', 'project_id')
            ->with(['assignedUser:id,fullname', 'project:id,title']) 
            ->orderBy('id', 'desc')
            ->get();
        
        return view('admin.logs', compact('users', 'projects', 'tasks'));
    }
    
}
