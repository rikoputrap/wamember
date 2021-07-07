<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Edit Member</h1>
    <form action="{{ route('member.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="">Nama</label>
        <input type="text" name="name" id="" value="{{ $member->name }}">
        <label for="">Telepon</label>
        <input type="text" name="phone" id="" value="{{ $member->phone }}">
        <label for="">Alamat</label>
        <input type="text" name="address" id="" value="{{ $member->address }}">
        <button type="submit">Simpan</button>
    </form>
</body>

</html>