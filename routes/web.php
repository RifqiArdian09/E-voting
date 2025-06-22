<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::get('/login-vote', [VoteController::class, 'showLoginForm'])->name('vote.login');
Route::post('/login-vote', [VoteController::class, 'login']);

Route::get('/vote/{token}', [VoteController::class, 'showVotePage'])->name('vote.page');
Route::post('/vote/{token}', [VoteController::class, 'submitVote'])->name('vote.submit');

Route::get('/vote/results', [VoteController::class, 'showHasil'])->name('vote.hasil');
Route::get('/candidates/{id}', [WelcomeController::class, 'show'])->name('candidate.show');
