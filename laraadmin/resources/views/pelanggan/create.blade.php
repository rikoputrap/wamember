<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('pelanggan.store') }}" method="post">
        @csrf
        <label for="">Nomor Pelanggan</label>
        <input type="text" name="nopel">
        <label for="">Nama Pelanggan</label>
        <input type="text" name="nama">
        <label for="">Alamat Pelanggan</label>
        <input type="text" name="alamat">
        <button type="submit">Tambah</button>
    </form>
</body>

</html>