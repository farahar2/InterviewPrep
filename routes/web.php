<?php
use App\Http\Controllers\ConceptController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProfileController;
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
    Route::resource('domains', DomainController::class);

    // Concept resource routes
    Route::get('/domains/{domain}/concepts', [ConceptController::class, 'index'])->name('concepts.index');
    Route::get('/domains/{domain}/concepts/create', [ConceptController::class, 'create'])->name('concepts.create');
    Route::post('/domains/{domain}/concepts', [ConceptController::class, 'store'])->name('concepts.store');
    Route::get('/concepts/{concept}', [ConceptController::class, 'show'])->name('concepts.show');
    Route::get('/concepts/{concept}/edit', [ConceptController::class, 'edit'])->name('concepts.edit');
    Route::match(['put', 'patch'], '/concepts/{concept}', [ConceptController::class, 'update'])->name('concepts.update');
    Route::delete('/concepts/{concept}', [ConceptController::class, 'destroy'])->name('concepts.destroy');
    Route::patch('/concepts/{concept}/status', [ConceptController::class, 'updateStatus'])->name('concepts.update-status');

    // Archived & Restore
    Route::get('/domains/{domain}/concepts/archived', [ConceptController::class, 'archived'])->name('concepts.archived');
    Route::patch('/concepts/{id}/restore', [ConceptController::class, 'restore'])->name('concepts.restore');
});

require __DIR__.'/auth.php';
