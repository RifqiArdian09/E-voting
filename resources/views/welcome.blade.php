<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Voting OSIS | SMK Negeri 1 </title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#2563eb',
            secondary: '#f59e0b',
            accent: '#3b82f6',
            dark: '#1e293b',
            light: '#f8fafc'
          },
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'fade-in': 'fadeIn 1s ease-in'
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-15px)' }
            }
          }
        }
      }
    }
  </script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      scroll-behavior: smooth;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .gradient-text {
      background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    .neumorphic {
      border-radius: 16px;
      background: #f8fafc;
      box-shadow:  8px 8px 16px #e2e8f0,
                  -8px -8px 16px #ffffff;
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .vote-btn {
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
    }
    .vote-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px rgba(37, 99, 235, 0.4);
    }
    .nav-link {
      position: relative;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -2px;
      left: 0;
      background-color: white;
      transition: width 0.3s ease;
    }
    .nav-link:hover::after {
      width: 100%;
    }
  </style>
</head>
<body class="bg-gray-50 text-slate-800">

  <!-- Floating Particles Background -->
  <div class="fixed inset-0 overflow-hidden -z-10">
    <div class="absolute top-1/4 left-1/4 w-4 h-4 rounded-full bg-blue-200 opacity-40 animate-float"></div>
    <div class="absolute top-1/3 right-1/4 w-6 h-6 rounded-full bg-amber-200 opacity-30 animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-1/4 right-1/3 w-5 h-5 rounded-full bg-blue-300 opacity-20 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute bottom-1/3 left-1/3 w-3 h-3 rounded-full bg-amber-300 opacity-30 animate-float" style="animation-delay: 3s;"></div>
  </div>

  <!-- Navbar -->
  <nav class="bg-white text-slate-800 p-4 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h1 class="text-xl font-bold text-primary">E-Vote<span class="font-light text-slate-600">OSIS</span></h1>
      </div>
      <ul class="hidden md:flex gap-8 items-center">
        <li><a href="#kandidat" class="nav-link text-sm font-medium hover:text-primary">Kandidat</a></li>
        <li><a href="#langkah" class="nav-link text-sm font-medium hover:text-primary">Langkah</a></li>
        <li><a href="#tentang" class="nav-link text-sm font-medium hover:text-primary">Tentang</a></li>
        <li><a href="#hasil" class="nav-link text-sm font-medium hover:text-primary">Hasil</a></li>
        <li><a href="{{ route('vote.login') }}" class="bg-primary px-4 py-2 rounded-lg text-sm font-semibold text-white hover:bg-blue-600 transition shadow-md">Vote Sekarang</a></li>
      </ul>
      <button class="md:hidden text-slate-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </nav>

  {{-- Notifikasi --}}
@if(session('success') || session('error'))
    <div 
        id="alertBox"
        class="relative bg-{{ session('success') ? 'green' : 'red' }}-100 border-l-4 border-{{ session('success') ? 'green' : 'red' }}-500 text-{{ session('success') ? 'green' : 'red' }}-700 p-4 rounded mb-6 shadow transition-opacity duration-500"
    >
        <p>{{ session('success') ?? session('error') }}</p>
        <button 
            onclick="document.getElementById('alertBox').remove()"
            class="absolute top-1 right-2 text-xl font-bold text-{{ session('success') ? 'green' : 'red' }}-700 hover:text-black"
        >
            &times;
        </button>
    </div>
@endif

<script>
    setTimeout(() => {
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
            alertBox.style.opacity = '0';
            setTimeout(() => alertBox.remove(), 500); // delay untuk animasi
        }
    }, 3000); // auto hilang 3 detik
</script>


  <!-- Hero Section -->
  <section class="relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 py-16 md:py-24 flex flex-col md:flex-row items-center gap-8 relative z-10">
      <div class="md:w-1/2 animate__animated animate__fadeInLeft">
        <h2 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Suara Anda Membentuk <span class="gradient-text">Masa Depan Sekolah</span></h2>
        <p class="mb-6 text-slate-600 text-lg">Partisipasi aktif Anda menentukan arah organisasi siswa di SMK Negeri 1 . Setiap suara berharga untuk perubahan yang lebih baik!</p>
        <div class="flex flex-col sm:flex-row gap-4">
          <a href="#kandidat" class="vote-btn bg-primary text-white px-6 py-3 rounded-lg font-semibold text-center">Lihat Kandidat</a>
          <a href="{{ route('vote.login') }}" class="bg-white text-primary border border-primary px-6 py-3 rounded-lg font-semibold text-center hover:bg-primary hover:text-white transition">Vote Sekarang</a>
        </div>
      </div>
      <div class="md:w-1/2 animate__animated animate__fadeInRight">
        <div class="relative">
          <div class="w-full max-w-lg mx-auto ">
            <img src="{{ asset('images/voting.svg') }}" alt="Students voting" class="w-full h-auto">
          </div>
      </div>
    </div>
  </section>

 <!-- Stats Section -->
<section class="bg-gradient-to-r from-primary to-accent text-white py-12">
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
      <div class="glass-card p-6 rounded-xl">
        <h3 class="text-4xl font-bold mb-2">{{ number_format($jumlahSiswa) }}</h3>
        <p class="text-white text-opacity-90">Siswa Terdaftar</p>
      </div>
      <div class="glass-card p-6 rounded-xl">
        <h3 class="text-4xl font-bold mb-2">{{ $jumlahKandidat }}</h3>
        <p class="text-white text-opacity-90">Kandidat Unggulan</p>
      </div>
      <div class="glass-card p-6 rounded-xl">
        <h3 class="text-2xl font-semibold mb-2">{{ $waktuTersisa }}</h3>
        <p class="text-white text-opacity-90">Waktu Tersisa</p>
      </div>
    </div>
  </div>
</section>



<!-- Section Kandidat -->
<section id="kandidat" class="py-16 px-4 bg-white">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-12">
      <h3 class="text-3xl font-bold text-primary mb-4">Kandidat Ketua OSIS</h3>
      <p class="text-slate-600 max-w-2xl mx-auto">Kenali visi, misi, dan program kerja calon ketua OSIS periode 2025/2026</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach ($candidates as $index => $candidate)
      <div class="neumorphic rounded-xl overflow-hidden card-hover transform transition duration-500 hover:scale-[1.02]">
        <div class="relative">
          <img src="{{ asset('storage/' . $candidate->photo) }}" alt="{{ $candidate->name }}" class="w-full h-64 object-cover">
          <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-20"></div>
          <div class="absolute bottom-4 left-4">
            <h4 class="text-xl font-bold text-white">{{ $candidate->name }}</h4>
            <p class="text-sm text-gray-200">Kelas belum ditentukan</p>
          </div>
          @if ($index === 1)
          <div class="absolute top-4 right-4 bg-secondary text-white text-xs font-bold px-2 py-1 rounded-full shadow">Favorit</div>
          @endif
        </div>
        <div class="p-6">
          <div class="flex items-center mb-4">
            <span class="bg-blue-100 text-primary text-xs font-semibold px-2.5 py-0.5 rounded">Nomor Urut {{ $index + 1 }}</span>
          </div>
          <p class="text-slate-600 mb-4 italic">"{{ $candidate->vision }}"</p>
          <div class="space-y-3 mb-6">
            @foreach (explode("\n", $candidate->mission) as $point)
            <div class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span class="text-sm">{{ $point }}</span>
            </div>
            @endforeach
          </div>
          <a href="#vote" class="block w-full text-center bg-primary text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition">Pilih Kandidat Ini</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>


  <!-- Langkah-langkah -->
  <section id="langkah" class="py-16 px-4 bg-slate-50">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <h3 class="text-3xl font-bold text-primary mb-4">Cara Memilih</h3>
        <p class="text-slate-600 max-w-2xl mx-auto">Ikuti langkah sederhana ini untuk menggunakan hak pilih Anda</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-xl shadow-sm text-center">
          <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">1</div>
          <h4 class="font-semibold text-lg mb-3">Login</h4>
          <p class="text-sm text-slate-600">Gunakan NIS dan password yang telah didaftarkan</p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-sm text-center">
          <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">2</div>
          <h4 class="font-semibold text-lg mb-3">Pelajari</h4>
          <p class="text-sm text-slate-600">Baca visi-misi dan program kerja masing-masing kandidat</p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-sm text-center">
          <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">3</div>
          <h4 class="font-semibold text-lg mb-3">Pilih</h4>
          <p class="text-sm text-slate-600">Tentukan pilihan Anda dan konfirmasi dengan Kode OTP</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Vote Section -->
  <section id="vote" class="py-16 px-4 bg-gradient-to-r from-primary to-accent text-white">
    <div class="max-w-4xl mx-auto text-center">
      <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl">
        <h3 class="text-3xl font-bold mb-6">Siap Menggunakan Hak Pilih Anda?</h3>
        <p class="mb-8 text-white/90 max-w-2xl mx-auto">Pemilihan akan ditutup dalam 24 jam. Pastikan suara Anda menentukan masa depan OSIS SMK Negeri 1 !</p>
        <a href="{{ route('vote.login') }}" class="inline-block bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg transform hover:scale-105">Vote Sekarang</a>
      </div>
    </div>
  </section>

  <!-- Tentang -->
  <section id="tentang" class="py-16 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row gap-12 items-center">
        <div class="md:w-1/2">
          <img src="{{ asset('images/ziga20.png') }}" alt="Tentang E-Voting" class="w-full max-w-md mx-auto">
        </div>
        <div class="md:w-1/2">
          <h3 class="text-3xl font-bold text-primary mb-6">Tentang E-Voting OSIS</h3>
          <p class="text-slate-600 mb-4">Sistem E-Voting OSIS SMK Negeri 1  adalah platform digital yang dikembangkan untuk memudahkan proses pemilihan ketua OSIS secara transparan, akuntabel, dan efisien.</p>
          <p class="text-slate-600 mb-6">Dengan sistem ini, seluruh siswa dapat memberikan suara secara online tanpa harus mengantri di tempat pemungutan suara, sekaligus mengurangi penggunaan kertas (paperless).</p>
          <div class="space-y-3">
            <div class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span class="text-slate-700">Proses pemilihan yang lebih cepat dan efisien</span>
            </div>
            <div class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span class="text-slate-700">Hasil real-time yang dapat dipercaya</span>
            </div>
            <div class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span class="text-slate-700">Sistem keamanan multi-layer</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Hasil Voting Section -->
<section id="hasil" class="py-12 md:py-16 px-4 bg-gray-50">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-primary mb-3">Hasil Voting Sementara</h2>
      <p class="text-gray-600 max-w-2xl mx-auto text-lg">Perkembangan hasil pemilihan ketua OSIS secara real-time</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
      <!-- Total Votes Card -->
      <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
        <div class="flex items-center">
          <div class="p-3 rounded-full bg-blue-50 text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <div class="ml-4">
            <h3 class="text-gray-500 text-sm font-medium">Total Suara</h3>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalSuara) }}</p>
          </div>
        </div>
      </div>

      <!-- Leading Candidate Card -->
      @php $leading = collect($processedCandidates)->sortByDesc('votes')->first(); @endphp
      <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500">
        <div class="flex items-center">
          <div class="p-3 rounded-full bg-green-50 text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
          </div>
          <div class="ml-4">
            <h3 class="text-gray-500 text-sm font-medium">Pemimpin Sementara</h3>
            <p class="text-xl font-bold text-gray-800">{{ $leading['name'] }}</p>
            <p class="text-sm text-gray-600">{{ $leading['votes'] }} suara ({{ $leading['percentage'] }}%)</p>
          </div>
        </div>
      </div>

      <!-- Participation Rate Card -->
      <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm font-medium">Partisipasi</h3>
                    <p class="text-2xl font-bold text-gray-800">{{ $partisipasi }}%</p>
                    <p class="text-sm text-gray-600">dari total pemilih terdaftar</p>
                </div>
            </div>
        </div>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
      <!-- Bar Chart -->
      <div class="bg-white p-6 rounded-xl shadow-md">
  <h3 class="text-lg font-semibold text-gray-800 mb-4">Perolehan Suara</h3>
  <div class="h-64 mt-8">
    <div class="flex items-end h-64 space-x-3">
      @foreach ($processedCandidates as $item)
        <div class="flex flex-col items-center flex-1 h-full bg-gray-100 rounded-md">
          <div 
            class="w-full bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-md transition-all duration-500 hover:from-blue-600 hover:to-blue-500"
            style="height: {{ $item['percentage'] }}%;"
            title="{{ $item['name'] }}: {{ $item['percentage'] }}%">
          </div>
          <div class="mt-2 text-center">
            <div class="h-10 w-10 mx-auto rounded-full overflow-hidden border-2 border-white shadow-md">
              <img src="{{ $item['photo'] ? asset('storage/' . $item['photo']) : 'https://via.placeholder.com/40' }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
            </div>
            <span class="block mt-2 text-sm font-medium text-gray-700">{{ $item['name'] }}</span>
            <span class="block text-xs text-blue-600 font-bold">{{ $item['percentage'] }}%</span>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>


      <!-- Pie Chart Placeholder -->
      <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Suara</h3>
        <div class="h-64 flex items-center justify-center">
          <div class="relative w-48 h-48">
            @php
              $offset = 0;
              $colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'];
            @endphp
            
            @foreach ($processedCandidates as $index => $item)
            <div class="absolute inset-0">
              <svg viewBox="0 0 100 100" class="w-full h-full">
                <circle 
                  cx="50" 
                  cy="50" 
                  r="45" 
                  fill="transparent"
                  stroke="{{ $colors[$index % count($colors)] }}"
                  stroke-width="10"
                  stroke-dasharray="{{ $item['percentage'] * 2.83 }} 283"
                  stroke-dashoffset="{{ $offset }}"
                  transform="rotate(-90 50 50)"
                ></circle>
              </svg>
            </div>
            @php $offset -= $item['percentage'] * 2.83; @endphp
            @endforeach
            
            <div class="absolute inset-0 flex items-center justify-center">
              <div class="text-center">
                <span class="text-2xl font-bold text-gray-800">{{ $totalSuara }}</span>
                <span class="block text-sm text-gray-500">total suara</span>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4 flex flex-wrap justify-center gap-3">
          @foreach ($processedCandidates as $index => $item)
          <div class="flex items-center">
            <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ $colors[$index % count($colors)] }}"></span>
            <span class="text-sm text-gray-600">{{ $item['name'] }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Detailed Results Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kandidat</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Suara</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($processedCandidates as $item)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden border-2 border-white shadow-sm">
                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $item['photo']) }}" alt="Foto {{ $item['name'] }}">
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ $item['name'] }}</div>
                    <div class="text-sm text-gray-500">Kandidat #{{ $loop->iteration }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900 font-medium">{{ number_format($item['votes']) }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                  {{ $item['percentage'] }}%
                </span>
              </td>
              <td class="px-6 py-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div 
                    class="bg-gradient-to-r from-blue-500 to-blue-400 h-2 rounded-full" 
                    style="width: {{ $item['percentage'] }}%"
                  ></div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Note -->
    <div class="mt-8 text-center">
      <div class="inline-flex items-center bg-blue-50 text-blue-700 px-4 py-2 rounded-lg text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
        </svg>
        Hasil ini bersifat sementara dan akan diperbarui secara real-time
      </div>
    </div>
  </div>
</section>


  <!-- Footer -->
  <footer id="footer" class="bg-slate-900 text-white py-12 px-4">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-xl font-bold">E-Vote<span class="font-light">OSIS</span></h3>
          </div>
          <p class="text-slate-400 text-sm">Platform digital untuk pemilihan ketua OSIS SMK Negeri 1 .</p>
        </div>
        <div>
          <h4 class="font-semibold text-lg mb-4">Tautan Cepat</h4>
          <ul class="space-y-2">
            <li><a href="#kandidat" class="text-slate-400 hover:text-white transition">Kandidat</a></li>
            <li><a href="#langkah" class="text-slate-400 hover:text-white transition">Langkah Voting</a></li>
            <li><a href="#tentang" class="text-slate-400 hover:text-white transition">Tentang</a></li>
            <li><a href="#hasil" class="text-slate-400 hover:text-white transition">Hasil</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold text-lg mb-4">Kontak</h4>
          <ul class="space-y-2 text-slate-400">
            <li class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              (021) 1234567
            </li>
            <li class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              evoting@smkn1.sch.id
            </li>
            <li class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              Jl. Pendidikan No. 123, 
            </li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold text-lg mb-4">Sosial Media</h4>
          <div class="flex space-x-4">
            <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
              </svg>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
              </svg>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.597 0-2.917-.01-3.96-.058-.976-.045-1.505-.207-1.858-.344a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="border-t border-slate-800 mt-8 pt-8 text-center text-slate-400 text-sm">
        <p>&copy; 2025 E-Voting OSIS | SMK Negeri 1 . All rights reserved.</p>
      </div>
    </div>
  </footer>
</body>
</html>