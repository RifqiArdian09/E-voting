<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Voting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .vote-btn {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
        }

        .vote-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(37, 99, 235, 0.4);
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
        }

        .candidate-image {
            transition: transform 0.5s ease;
        }

        .candidate-image:hover {
            transform: scale(1.05);
        }

        .gradient-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
            }
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body class="min-h-screen py-10 px-4">
    <!-- Floating decorative elements -->
    <div class="fixed inset-0 overflow-hidden -z-10">
        <div class="absolute top-1/4 left-1/4 w-4 h-4 rounded-full bg-blue-200 opacity-40 animate-pulse"></div>
        <div class="absolute top-1/3 right-1/4 w-6 h-6 rounded-full bg-blue-100 opacity-30 floating" style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-10 text-center border border-gray-100">
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="absolute -bottom-1 -right-1 bg-blue-500 text-white rounded-full p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mt-4">Pemilihan Ketua OSIS</h1>
                <p class="text-blue-600 font-medium">Tahun Ajaran 2025/2026</p>
            </div>
            
            <div class="bg-blue-50 rounded-lg p-4 mb-4 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700">Selamat datang, <span class="font-semibold text-blue-600">{{ $voter->name }}</span></span>
            </div>
            
            <div class="text-sm text-gray-500 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Waktu tersisa: {{ $waktuTersisa }}</span>
            </div>
        </div>

        <!-- Notification Area -->
        @if(session('success'))
        <div id="notification" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-lg shadow-md animate-fade-in">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="font-semibold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
                <button onclick="document.getElementById('notification').remove()" class="ml-auto text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Candidates Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($candidates as $candidate)
                <div class="card bg-white rounded-xl overflow-hidden border border-gray-100">
                    <!-- Candidate Photo -->
                    <div class="relative h-64 overflow-hidden">
                        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $candidate->photo) }}" 
                                 alt="{{ $candidate->name }}" 
                                 class="candidate-image w-full h-full object-cover object-center">
                        </div>
                        <div class="gradient-overlay absolute bottom-0 left-0 right-0 h-24"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <h2 class="text-xl font-bold text-white">{{ $candidate->name }}</h2>
                            <p class="text-blue-100 text-sm">Kandidat No. {{ $loop->iteration }}</p>
                        </div>
                        
                    </div>

                    <!-- Candidate Info -->
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-sm font-semibold text-blue-600 mb-1">Visi</h3>
                            <p class="text-gray-700 italic text-sm line-clamp-2">"{{ $candidate->vision }}"</p>
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-blue-600 mb-1">Misi</h3>
                            <ul class="space-y-2">
                                @foreach(array_slice(explode("\n", $candidate->mission), 0, 3) as $point)
                                <li class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-600 text-sm">{{ $point }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Voting Form -->
                        <form action="{{ route('vote.submit', $token) }}" method="POST" class="vote-form">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="button" 
                                    onclick="confirmVote('{{ $candidate->name }}', this)"
                                    class="vote-btn w-full text-white py-3 px-4 rounded-lg font-medium flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
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
        <div class="mt-10 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center mb-4">
                <div class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Panduan Memilih</h3>
            </div>
            <div class="space-y-3">
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-600">Pilih salah satu kandidat dengan menekan tombol "Pilih Kandidat Ini"</span>
                </div>
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-600">Anda hanya dapat memilih satu kali dan tidak dapat mengubah pilihan</span>
                </div>
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-600">Pastikan Anda telah mempertimbangkan visi dan misi setiap kandidat</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-hide notification after 5 seconds
        @if(session('success'))
        setTimeout(() => {
            document.getElementById('notification').remove();
        }, 5000);
        @endif

        // Enhanced confirmation dialog
        function confirmVote(candidateName, button) {
            const form = button.closest('.vote-form');
            
            Swal.fire({
                title: `Pilih ${candidateName}?`,
                text: "Anda yakin memilih kandidat ini sebagai ketua OSIS? Pilihan tidak dapat diubah setelah dikirim.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Saya Yakin',
                cancelButtonText: 'Batal',
                backdrop: `
                    rgba(59, 130, 246, 0.2)
                    url("/images/nyan-cat.gif")
                    center top
                    no-repeat
                `,
                width: '600px',
                customClass: {
                    title: 'text-xl font-bold text-gray-800',
                    content: 'text-gray-600',
                    confirmButton: 'px-4 py-2 rounded-lg font-medium',
                    cancelButton: 'px-4 py-2 rounded-lg font-medium'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    button.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    `;
                    button.disabled = true;
                    
                    // Submit the form
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>