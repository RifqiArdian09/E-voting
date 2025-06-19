<!DOCTYPE html>
<html>
<head><title>Login Pemilih</title></head>
<body>
    <h2>Login Pemilih</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('vote.login') }}">
        @csrf
        <input type="text" name="token" placeholder="Masukkan Token" required><br>
        <button type="submit">Masuk ke Voting</button>
    </form>

    @if ($errors->any())
        <div style="color:red">{{ $errors->first() }}</div>
    @endif
</body>
</html>
