<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="">Nomor Pelanggan</label>
        <input type="text" name="nopel" value="{{ $pelanggan->nopel }}">
        <label for="">Nama Pelanggan</label>
        <input type="text" name="nama" value="{{ $pelanggan->nama }}">
        <label for="">Alamat Pelanggan</label>
        <input type="text" name="alamat" value="{{ $pelanggan->alamat }}">
        <button type="submit">Update</button>
    </form>
</body>

</html>