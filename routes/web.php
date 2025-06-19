<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Voter;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Setting;

Route::get('/', function () {
    return view('welcome');
});

// Register Form
Route::get('/register', function () {
    return view('vote.register');
})->name('vote.register');

// Register Process
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:voters,email',
    ]);

    $token = Str::uuid();
    $voter = Voter::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'token' => $token,
        'has_voted' => false,
    ]);

    return redirect()->route('vote.login')->with('success', 'Akun berhasil dibuat. Silakan login.');
});

// Login Form
Route::get('/login-vote', function () {
    return view('vote.login');
})->name('vote.login');

// Login Process
Route::post('/login-vote', function (Request $request) {
    $request->validate([
        'token' => 'required|exists:voters,token',
    ]);

    $token = $request->input('token');
    return redirect()->route('vote.page', $token);
});

// Halaman Voting
Route::get('/vote/{token}', function ($token) {
    $voter = Voter::where('token', $token)->firstOrFail();

    if ($voter->has_voted) {
        return view('vote.already_voted');
    }

    $setting = Setting::first();
    $now = now();

    if ($setting && ($now->lt($setting->voting_start) || $now->gt($setting->voting_end))) {
        return abort(403, 'Voting tidak aktif saat ini.');
    }

    $candidates = Candidate::all();
    return view('vote.index', compact('voter', 'candidates'));
})->name('vote.page');

// Proses Vote
Route::post('/vote/{token}', function (Request $request, $token) {
    $voter = Voter::where('token', $token)->firstOrFail();

    if ($voter->has_voted) {
        return view('vote.already_voted');
    }

    $request->validate([
        'candidate_id' => 'required|exists:candidates,id',
    ]);

    Vote::create([
        'voter_id' => $voter->id,
        'candidate_id' => $request->candidate_id,
    ]);

    $voter->update(['has_voted' => true]);

    return view('vote.success');
})->name('vote.submit');