<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoterController extends Controller
{
    public function showLoginForm()
    {
        return view('voter.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $voter = Voter::where('token', $request->token)->first();

        if (!$voter) {
            return back()->with('error', 'Token tidak valid');
        }

        Auth::guard('voter')->login($voter);

        return redirect()->route('voter.dashboard');
    }

    public function dashboard()
    {
        $voter = Auth::guard('voter')->user();
        $settings = Setting::first();
        $candidates = Candidate::withCount('votes')->get();

        return view('voter.dashboard', compact('voter', 'settings', 'candidates'));
    }

    public function vote(Request $request)
    {
        $voter = Auth::guard('voter')->user();
        $settings = Setting::first();

        // Validasi waktu voting
        if (now() < $settings->voting_start || now() > $settings->voting_end) {
            return back()->with('error', 'Waktu voting tidak valid');
        }

        // Cek apakah sudah vote
        if ($voter->has_voted) {
            return back()->with('error', 'Anda sudah melakukan voting');
        }

        $request->validate([
            'candidate_id' => 'required|exists:candidates,id'
        ]);

        // Proses voting
        Vote::create([
            'voter_id' => $voter->id,
            'candidate_id' => $request->candidate_id
        ]);

        $voter->update(['has_voted' => true]);

        return redirect()->route('voter.dashboard')->with('success', 'Terima kasih, voting Anda telah tercatat!');
    }

    public function logout()
    {
        Auth::guard('voter')->logout();
        return redirect()->route('voter.login');
    }
}