<!DOCTYPE html>
<html>
<head>
    <title>Halaman Voting</title>
</head>
<body>
    <h2>Selamat datang, {{ $voter->name }}</h2>
    <p>Silakan pilih salah satu kandidat di bawah ini:</p>

    <form action="{{ route('vote.submit', $voter->token) }}" method="POST">
        @csrf
        @foreach ($candidates as $candidate)
            <div style="margin-bottom: 15px;">
                <label>
                    <input type="radio" name="candidate_id" value="{{ $candidate->id }}" required>
                    <strong>{{ $candidate->name }}</strong><br>
                    <em>Visi:</em> {{ $candidate->vision }}<br>
                    <em>Misi:</em> {{ $candidate->mission }}<br>
                    @if ($candidate->photo)
                        <img src="{{ asset('storage/' . $candidate->photo) }}" width="100">
                    @endif
                </label>
            </div>
        @endforeach

        <button type="submit">Kirim Suara</button>
    </form>
</body>
</html>
