<?php
use App\Http\Controllers\ConceptController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerationController;

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
    Route::get('/domains/{domain}/concepts', [ConceptController::class, 'index'])
        ->name('concepts.index');
    
    // Create concept for a domain
    Route::get('/domains/{domain}/concepts/create', [ConceptController::class, 'create'])
        ->name('concepts.create');
    Route::post('/domains/{domain}/concepts', [ConceptController::class, 'store'])
        ->name('concepts.store');
    
    // Show, edit, update, delete concept (not nested)
    Route::get('/concepts/{concept}', [ConceptController::class, 'show'])
        ->name('concepts.show');
    Route::get('/concepts/{concept}/edit', [ConceptController::class, 'edit'])
        ->name('concepts.edit');
    Route::put('/concepts/{concept}', [ConceptController::class, 'update'])
        ->name('concepts.update');
    Route::delete('/concepts/{concept}', [ConceptController::class, 'destroy'])
        ->name('concepts.destroy');
    
    // Quick status change (AJAX)
    Route::patch('/concepts/{concept}/status', [ConceptController::class, 'updateStatus'])
        ->name('concepts.update-status');
});

require __DIR__.'/auth.php';
