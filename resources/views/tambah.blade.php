<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penambahan</title>
</head>

<body>
    <h1>{{$title ?? ''}}</h1>
    <a href="{{ url()->previous() }}">Kembali</a>
    <form action="{{ route('tambah-action') }}" method="POST">
        @csrf
        <input type="hidden" name="" value="">
        <label for="">Angka 1</label>
        <input type="text" name="angka1" placeholder="Masukan Angka">
        <br>
        <label for="">Angka 2</label>
        <input type="text" name="angka2" placeholder="Masukan Angka">
        <br>
        <button type="submit">Simpan</button>
    </form>
    @if (isset($jumlah))
        <h1>Hasilnya adalah {{ $jumlah }} </h1>
    @endif

    @if (isset($error))
        <h2>{{ $error }}</h2>
    @endif

</body>

</html>
