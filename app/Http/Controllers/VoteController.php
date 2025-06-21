<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Session;

class VoteController extends Controller
{
    public function showLoginForm()
    {
        return view('vote.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        $token = strtoupper($request->input('token'));
        $voter = Voter::where('token', $token)->first();

        if ($voter) {
            Session::put('voter_id', $voter->id);
            return redirect()->route('vote.page', ['token' => $token]);
        }

        return back()->with('error', 'Token tidak ditemukan.');
    }

    public function showVotePage($token)
    {
        $voter = Voter::where('token', $token)->firstOrFail();

        if (Session::get('voter_id') != $voter->id) {
            return redirect()->route('vote.login')->with('error', 'Token tidak valid.');
        }

        $candidates = Candidate::all();
        $hasVoted = $voter->has_voted;

        // ✅ Pastikan token dikirim ke view agar tidak undefined
        return view('vote.page', compact('voter', 'candidates', 'hasVoted', 'token'));
    }

    public function submitVote(Request $request, $token)
    {
        $voter = Voter::where('token', $token)->firstOrFail();

        if ($voter->has_voted) {
            return back()->with('error', 'Anda sudah memilih.');
        }

        $request->validate([
            'candidate_id' => 'required|exists:candidates,id'
        ]);

        Vote::create([
            'voter_id' => $voter->id,
            'candidate_id' => $request->candidate_id
        ]);

        $voter->has_voted = true;
        $voter->save();

        return back()->with('success', 'Terima kasih sudah memilih!');
    }
}
