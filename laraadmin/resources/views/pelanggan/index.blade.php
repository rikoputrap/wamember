<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Data Pelanggan</h1>
    <table>
        <tr>
            <th>Nomor Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat Pelanggan</th>
            <th colspan="2">Opsi</th>
        </tr>
        @foreach($pelanggan as $p)
        <tr>
            <td>{{ $p->nopel }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->alamat }}</td>
            <td><a href="{{ route('pelanggan.edit', $p->id) }}">Edit</a></td>
            <td>
                <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>