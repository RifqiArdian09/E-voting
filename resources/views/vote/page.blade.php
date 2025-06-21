<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Voting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .vote-btn {
            background: linear-gradient(to right, #2563eb, #3b82f6);
            transition: all 0.3s ease;
        }

        .vote-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body class="min-h-screen py-10 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 text-center">
            <div class="flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h1 class="text-3xl font-bold text-blue-700">Pemilihan Ketua OSIS</h1>
            </div>
            <p class="text-gray-600 mb-2">Selamat datang, <span class="font-semibold text-blue-600">{{ $voter->name }}</span></p>
            <p class="text-gray-500">Gunakan hak suara Anda dengan bijak</p>
        </div>

        <!-- Candidates Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($candidates as $candidate)
                <div class="card bg-white rounded-xl overflow-hidden">
                    <!-- Candidate Photo -->
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('storage/' . $candidate->photo) }}" 
                             alt="{{ $candidate->name }}" 
                             class="w-full h-full object-cover transition duration-500 hover:scale-105">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent h-16"></div>
                    </div>

                    <!-- Candidate Info -->
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $candidate->name }}</h2>
                        <div class="border-l-4 border-blue-500 pl-3 mb-4">
                            <p class="text-gray-600 font-semibold">Visi:</p>
                            <p class="text-gray-700 italic mb-2">{{ $candidate->vision }}</p>
                            <p class="text-gray-600 font-semibold">Misi:</p>
                            <p class="text-gray-700 italic">{{ $candidate->mission }}</p>
                        </div>

                        <!-- Voting Form -->
                        <form action="{{ route('vote.submit', $token) }}" method="POST">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="submit" 
                                    onclick="return confirm('Anda yakin memilih {{ $candidate->name }} sebagai ketua OSIS?')"
                                    class="vote-btn w-full text-white py-3 px-4 rounded-lg font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Pilih Kandidat Ini
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Additional Info -->
        <div class="mt-10 bg-white rounded-xl shadow-sm p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Panduan Memilih</h3>
            <p class="text-gray-600 mb-4">Pilih salah satu kandidat dengan menekan tombol "Pilih Kandidat Ini"</p>
            <div class="flex items-center justify-center text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Anda hanya dapat memilih satu kali</span>
            </div>
        </div>
    </div>
</body>
</html>
