<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TodoController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::post('/todos', [TodoController::class, 'store'])->middleware(['auth']);
    Route::put('/todos/{id}', [TodoController::class, 'update'])->middleware(['auth']);
    Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->middleware(['auth']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
