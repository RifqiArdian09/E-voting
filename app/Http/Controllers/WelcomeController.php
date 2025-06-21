<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Voter;
use App\Models\Setting;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        // Ambil semua kandidat dan jumlah suaranya
        $candidates = Candidate::withCount('votes')->get();

        // Total semua suara
        $totalSuara = $candidates->sum('votes_count');

        // Hitung persentase dan format data untuk grafik dan tampilan
        $processedCandidates = $candidates->map(function ($candidate) use ($totalSuara) {
            $percentage = $totalSuara > 0 ? round(($candidate->votes_count / $totalSuara) * 100) : 0;
            return [
                'id' => $candidate->id,
                'name' => $candidate->name,
                'photo' => $candidate->photo,
                'vision' => $candidate->vision,
                'mission' => $candidate->mission,
                'votes' => $candidate->votes_count,
                'percentage' => $percentage,
            ];
        });

        // Jumlah siswa dan kandidat
        $jumlahSiswa = Voter::count();
        $jumlahKandidat = Candidate::count();

        // Hitung waktu tersisa dari setting
        $setting = Setting::first();
        $waktuTersisa = 'Selesai';

        if ($setting && now()->lessThan($setting->voting_end)) {
            $diff = now()->diff(Carbon::parse($setting->voting_end));
            $waktuTersisa = "{$diff->d} Hari {$diff->h} Jam {$diff->i} Menit";
        }

        // Kirim ke view
        return view('welcome', compact(
            'candidates',         // Untuk tampilkan info lengkap kandidat
            'processedCandidates',// Untuk statistik hasil voting
            'totalSuara',         // Total semua suara
            'jumlahSiswa',        // Total pemilih
            'jumlahKandidat',     // Total kandidat
            'waktuTersisa'        // Hitung mundur
        ));
    }
}
