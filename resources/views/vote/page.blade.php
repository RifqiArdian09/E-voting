<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Voting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h1 class="text-2xl font-bold mb-2 text-blue-700">Selamat Datang, {{ $voter->name }}</h1>
            <p class="text-gray-600">Silakan pilih salah satu calon ketua OSIS di bawah ini.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($voter->has_voted)
            <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded">
                Anda sudah menggunakan hak suara. Terima kasih telah berpartisipasi!
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($candidates as $candidate)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition">
                        <img src="{{ $candidate->photo_url ?? 'https://via.placeholder.com/300x200' }}" 
                             alt="Foto Calon" class="w-full h-48 object-cover rounded mb-4">
                        <h2 class="text-lg font-bold text-gray-800">{{ $candidate->name }}</h2>
                        <p class="text-sm text-gray-600 mb-2">No Urut: {{ $candidate->number }}</p>
                        <p class="text-sm italic text-gray-500 mb-4">"{{ $candidate->slogan }}"</p>
                        <form action="{{ route('vote.submit', $token) }}" method="POST">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="submit" 
                                    onclick="return confirm('Yakin memilih {{ $candidate->name }}?')"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                PILIH
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
