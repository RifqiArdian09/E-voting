<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Setting;
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
            'nisn'=>'required',
            'token' => 'required'
        ]);

        $token = strtoupper($request->input('token'));
        $voter = Voter::where('token', $token)->first();

        if ($voter) {
            if ($voter->has_voted) {
                return redirect()->route('welcome')->with('error', 'Anda sudah menggunakan hak suara.');
            }
            if ($voter->nisn != $request->input('nisn')) {
                return back()->with('error', 'NISN tidak sesuai dengan token.');
            }
            Session::put('nisn', $request->input('nisn'));
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

        if ($voter->has_voted) {
            return redirect()->route('welcome')->with('error', 'Anda sudah memilih.');
        }

        $setting = Setting::first();
        if (!$setting) {
            return redirect()->route('vote.login')->with('error', 'Pengaturan voting belum dikonfigurasi.');
        }

        $now = now();
        if ($now->lt($setting->voting_start)) {
            return redirect()->route('vote.login')->with('error', 'Voting belum dimulai.');
        }

        if ($now->gt($setting->voting_end)) {
            return redirect()->route('vote.login')->with('error', 'Waktu voting telah berakhir.');
        }

        $candidates = Candidate::all();

        return view('vote.page', compact('voter', 'candidates', 'token'));
    }

    public function submitVote(Request $request, $token)
    {
        $voter = Voter::where('token', $token)->firstOrFail();

        if ($voter->has_voted) {
            return back()->with('error', 'Anda sudah memilih.');
        }

        $setting = Setting::first();
        $now = now();

        if (!$setting || $now->lt($setting->voting_start)) {
            return redirect()->route('vote.login')->with('error', 'Voting belum dibuka.');
        }

        if ($now->gt($setting->voting_end)) {
            return redirect()->route('vote.login')->with('error', 'Waktu voting sudah berakhir.');
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

        return redirect()->route('welcome')->with('success', 'Terima kasih sudah memilih!');
    }
}
