<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/album/create', [AlbumController::class, 'create'])->name('album.create');
});
Route::middleware('auth')->group(function () {
    Route::get('/', [AlbumController::class, 'index'])->name('album.index');
});

Route::get('/dashboard', function () {
    return redirect('/album');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});
Route::middleware('auth')->group(function () {
    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::get('/album/{album}', [AlbumController::class, 'show'])->name('album.show');
    Route::post('/rating/store', [RatingController::class, 'store'])->name('rating.store');
});


Route::middleware(['auth','admin'])->group(function () {
    // 1. La página para VER el formulario
    Route::post('/album/store', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/album/{album}/edit', [AlbumController::class, 'edit'])->name('album.edit');
    // 2. La acción de GUARDAR los datos (la que ya tienes)

});




Route::middleware('auth')->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

Route::get('/panel-control', function () {
    return "Bienvenido, Administrador. Aquí mandas tú.";
})->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';
