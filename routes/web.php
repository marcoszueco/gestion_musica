<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

Route::get('/album', [AlbumController::class, 'index'])->name('album.index')->middleware(['auth']);

Route::get('/panel-control', function () {
    return "Bienvenido, Administrador. Aquí mandas tú.";
})->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';
