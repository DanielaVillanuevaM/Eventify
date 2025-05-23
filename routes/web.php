<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventsController;
use \App\Http\Controllers\UsersController;
use App\Http\Controllers\InscripcionesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin views
    Route::get('/crudEvents', [EventsController::class, 'CRUDindex'])->name('crudEvents.index');

    Route::get('/crudUsers', [UsersController::class, 'CRUDindex'])->name('crudUsers.index');

    Route::get('/crudInscripciones', [InscripcionesController::class, 'CRUDindex'])->name('crudInscripciones.index');
});

require __DIR__ . '/auth.php';
