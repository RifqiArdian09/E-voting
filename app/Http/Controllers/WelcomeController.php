<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class WelcomeController extends Controller
{
  

    public function index()
    {
        $candidates = Candidate::withCount('votes')->get();
    
        $labels = $candidates->pluck('name');
        $data = $candidates->pluck('votes_count');
    
        return view('welcome', compact('labels', 'data'));
    }
    
}
