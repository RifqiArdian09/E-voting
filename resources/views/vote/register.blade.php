<!DOCTYPE html>
<html>
<head><title>Daftar Pemilih</title></head>
<body>
    <h2>Form Registrasi Pemilih</h2>
    <form method="POST" action="{{ route('vote.register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Daftar</button>
    </form>

    @if ($errors->any())
        <div>{{ $errors->first() }}</div>
    @endif
</body>
</html>
