<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExerciseController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->prefix('/admin')
    ->group(function() {
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermissions'])->name('roles.permissions');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('exercises', ExerciseController::class);
});

Route::post('/workouts/{workout}/categories', [WorkoutController::class, 'selectCategories'])->name('workouts.categories');
Route::post('/workouts/{workout}/exercises', [WorkoutController::class, 'assignExercises'])->name('workouts.exercises');
Route::post('/workouts/{workout}/attach.exercise', [WorkoutController::class, 'attachExercise'])->name('workouts.attach.exercise');
Route::post('/workouts/{workout}/detach.exercise', [WorkoutController::class, 'detachExercise'])->name('workouts.detach.exercise');
Route::get('/workouts/{workout}/update.exercise', [WorkoutController::class, 'updateExercise'])->name('workouts.update.exercise');
Route::put('/workouts/{workout}/update.beschreibung', [WorkoutController::class, 'updateBeschreibung'])->name('workouts.update.beschreibung');
Route::resource('/workouts', WorkoutController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
