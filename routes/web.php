<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardController;

Route::get('/', [AppController::class, 'welcome'])->name('home');

Route::get('/template', [AppController::class, 'template'])->name('template');


// 🔐 Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* template */

// ✅ Group route yang butuh login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.users');
    
    // admin
    Route::post('/admin/users/{id}/make-premium', [DashboardController::class, 'makePremium'])->name('admin.makePremium');
    Route::post('/admin/users/{id}/make-gratis', [DashboardController::class, 'makeGratis'])->name('admin.makeGratis');
    Route::resource('templates-app', TemplateController::class);


    Route::get('/profile', [DashboardController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [DashboardController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [DashboardController::class, 'update'])->name('profile.update');
    
    Route::get('/project', [DashboardController::class, 'project'])->name('project');
    Route::get('/editor/{id?}', [AppController::class, 'editor'])->name('editor');
    Route::delete('/project/{id}', [AppController::class, 'destroy'])->name('project.delete');


    Route::post('/project-store', [AppController::class, 'store'])->name('project.store');
});