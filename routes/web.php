<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/candidates', function () {
    $candidates = \App\Models\Candidate::all();
    return view('candidates.index', compact('candidates'));
})->name('candidates.index');

Route::get('/login-vote', [VoteController::class, 'showLoginForm'])->name('vote.login');
Route::post('/login-vote', [VoteController::class, 'login']);

Route::get('/vote/{token}', [VoteController::class, 'showVotePage'])->name('vote.page');
Route::post('/vote/{token}', [VoteController::class, 'submitVote'])->name('vote.submit');

