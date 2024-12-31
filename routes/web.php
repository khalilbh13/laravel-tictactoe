<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LeaderboardController;


Route::get('/', function () {
    return redirect()->route('game.index');
});

// Routes du jeu
Route::get('/game', [GameController::class, 'index'])->name('game.index');
Route::get('/game/play/{row}/{col}', [GameController::class, 'play'])->name('game.play');
Route::get('/game/reset', [GameController::class, 'reset'])->name('game.reset');

// Routes du leaderboard
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
