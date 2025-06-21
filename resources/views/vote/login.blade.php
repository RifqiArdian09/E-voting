<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login E-Voting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .login-container {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .illustration {
            background: linear-gradient(to right, #2563eb, #3b82f6);
        }
        
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }
        
        .login-btn {
            transition: all 0.3s ease;
            background: linear-gradient(to right, #2563eb, #3b82f6);
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="login-container bg-white w-full max-w-4xl flex flex-col md:flex-row">
        <!-- Bagian Kiri (Gambar) -->
        <div class="illustration hidden md:flex flex-col items-center justify-center p-8 md:w-1/2 text-white">
            <img src="{{ asset('images/vote.png') }}" alt="Voting Illustration" class="w-full max-w-xs mb-6">
            <h2 class="text-2xl font-bold mb-2">Pemilihan OSIS Digital</h2>
            <p class="text-center text-blue-100">Gunakan hak pilih Anda untuk menentukan masa depan sekolah</p>
            
        </div>
        
        <!-- Bagian Kanan (Form) -->
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <div class="text-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h1 class="text-3xl font-bold mt-2 text-gray-800">Login E-Voting</h1>
                <p class="text-gray-600 mt-2">Masukkan token voting Anda</p>
            </div>

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-lg border border-red-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('vote.login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="token" class="block text-sm font-medium text-gray-700 mb-1">Token Voting</label>
                    <div class="relative">
                        <input type="text" name="token" id="token" required 
                               class="input-field w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Masukkan token Anda">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="login-btn w-full text-white py-3 px-4 rounded-lg font-semibold">
                    Masuk ke Sistem Voting
                </button>
            </form>
        </div>
    </div>
</body>
</html>