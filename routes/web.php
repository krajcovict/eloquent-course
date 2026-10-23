<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');

Route::resource('companies', CompanyController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';
