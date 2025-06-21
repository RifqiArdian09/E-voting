<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login E-Voting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Login E-Voting OSIS</h1>

        @if(session('error'))
            <div class="mb-4 text-sm text-red-600 bg-red-100 px-4 py-2 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('vote.login') }}">
            @csrf
            <div class="mb-4">
                <label for="token" class="block mb-1 text-gray-700">Masukkan Token</label>
                <input type="text" name="token" id="token" required 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Contoh: TOKEN123">
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                Masuk
            </button>
        </form>

        <p class="text-sm text-center text-gray-500 mt-4">Hubungi panitia jika belum punya token.</p>
    </div>
</body>
</html>
