<?php
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

    // Generation routes (AI questions)
Route::middleware(['auth'])->group(function () {
    // Generate questions for a concept
    Route::post('/concepts/{concept}/generate', [GenerationController::class, 'store'])
        ->name('generations.store');
    
    // Delete a generation
    Route::delete('/generations/{generation}', [GenerationController::class, 'destroy'])
        ->name('generations.destroy');
});
});

require __DIR__.'/auth.php';
