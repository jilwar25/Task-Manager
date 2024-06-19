<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $tasks = Task::where('user_id', auth()->id())
                    ->where('completed',false)
                    ->orderBy('priority', 'desc')
                    ->orderBy('due_date')
                    ->get();
    return view('dashboard', compact('tasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tasks',[TaskController::class,'index'])->name('tasks.index');
Route::get('/tasks/create',[TaskController::class,'create'])->name('tasks.create');
Route::post('/tasks',[TaskController::class,'store'])->name('tasks.store');
Route::get('/tasks/{task}',[TaskController::class,'edit'])->name('tasks.edit');
Route::put('/tasks/{task}',[TaskController::class,'update'])->name('tasks.update');
Route::delete('/tasks/{task}',[TaskController::class,'destroy'])->name('tasks.destroy');

require __DIR__.'/auth.php';
