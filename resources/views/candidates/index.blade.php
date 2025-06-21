<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Calon Ketua OSIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Daftar Calon Ketua OSIS</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($candidates as $candidate)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ $candidate->photo }}" alt="{{ $candidate->name }}" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h2 class="text-xl font-semibold">{{ $candidate->name }}</h2>
                        <p class="text-gray-600 text-sm mt-1">Total Suara: <strong>{{ $candidate->votes()->count() }}</strong></p>
                        <div class="mt-4">
                            <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                                x-data="{ open: false }"
                                @click="open = true">
                                Lihat Visi & Misi
                                <div
                                    x-show="open"
                                    @click.away="open = false"
                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                >
                                    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full p-6 relative">
                                        <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                            ✕
                                        </button>
                                        <h3 class="text-2xl font-bold mb-2">{{ $candidate->name }}</h3>
                                        <h4 class="font-semibold text-gray-700 mt-4 mb-1">Visi</h4>
                                        <p class="text-gray-600">{{ $candidate->vision }}</p>

                                        <h4 class="font-semibold text-gray-700 mt-4 mb-1">Misi</h4>
                                        <ul class="list-disc pl-5 text-gray-600">
                                            @foreach(explode("\n", $candidate->mission) as $misi)
                                                <li>{{ $misi }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('vote.login') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                Kembali ke Halaman Voting
            </a>
        </div>
    </div>
</body>
</html>
