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
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});
Route::middleware('auth')->group(function () {
    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/album/show', [AlbumController::class, 'show'])->name('album.show');
});
Route::middleware('auth')->group(function () {
    // 1. La página para VER el formulario
    Route::get('/album/create', [AlbumController::class, 'create'])->name('album.create');

    // 2. La acción de GUARDAR los datos (la que ya tienes)
    Route::post('/album/store', [AlbumController::class, 'store'])->name('album.store');
});

Route::get('/panel-control', function () {
    return "Bienvenido, Administrador. Aquí mandas tú.";
})->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';
