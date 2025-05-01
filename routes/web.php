<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);


Route::middleware(['auth'])->group(function () {

    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('/users', UserController::class);
        Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
        Route::get('/users', [AdminController::class, 'listUsers'])->name('users');

        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::resource('/admin/users', UserController::class)->except(['create', 'edit']);
        Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
        Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser']);

        // Remove or comment out this line to avoid conflict:
        // Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

        Route::resource('/projects', ProjectController::class);
        Route::get('/admin/project/show/{id}', [ProjectController::class, 'show'])->name('admin.project.show');
        Route::post('/projects/create', [ProjectController::class, 'store']);
        Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

        Route::resource('/tasks', TaskController::class);
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
        Route::post('/admin/tasks/store', [TaskController::class, 'store'])->name('admin.tasks.store');
        Route::get('/admin/tasks/show/{id}', [TaskController::class, 'show'])->name('admin.tasks.show');
        Route::post('/tasks/create', [TaskController::class, 'store']);
        Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/projects', [ReportController::class, 'projects'])->name('projects');
            Route::get('/tasks', [ReportController::class, 'tasks'])->name('tasks');
            Route::get('/users', [ReportController::class, 'users'])->name('users');
        });

        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings/update', [AdminController::class, 'updateSettings'])->name('settings.update');

        Route::get('/updates', [UpdateController::class, 'adminIndex'])->name('updates.index');

        Route::get('/logs', [AdminController::class, 'logs'])->name('admin.logs');

        Route::get('/discussion', [MessageController::class, 'index'])->name('discussion.index');
        Route::post('/discussion/send', [MessageController::class, 'sendMessage'])->name('discussion.send');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/tasks', [UserController::class, 'viewTasks'])->name('tasks');
        Route::get('/projects', [UserController::class, 'viewProjects'])->name('projects');
        Route::get('/notifications', [UserController::class, 'fetchNotifications'])->name('notifications');
        Route::post('/timesheet', [UserController::class, 'submitTimesheet'])->name('timesheet.submit');

        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
                
        Route::get('/updates', [UpdateController::class, 'index'])->name('updates.index');
        Route::get('/updates/create', [UpdateController::class, 'create'])->name('updates.create');
        Route::post('/updates', [UpdateController::class, 'store'])->name('updates.store');
        Route::get('/updates/{update}/edit', [UpdateController::class, 'edit'])->name('updates.edit');
        Route::put('/updates/{update}', [UpdateController::class, 'update'])->name('updates.update');
        Route::get('/updates/{update}/show', [UpdateController::class, 'show'])->name('updates.show');

        Route::get('/discussion', [MessageController::class, 'index'])->name('discussion.index');
        Route::post('/discussion/send', [MessageController::class, 'sendMessage'])->name('discussion.send');
    });
});

Route::fallback(function () {
    return view('errors.404');
});
