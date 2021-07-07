<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Data Member</h1>
    <a href="{{ route('member.create') }}">Tambah Member</a>
    <table>
        <tr>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th colspan="2">Opsi</th>
        </tr>
        @foreach($member as $m)
        <tr>
            <td>{{ $m->name }}</td>
            <td>{{ $m->phone }}</td>
            <td>{{ $m->address }}</td>
            <td>
                <a href="{{ route('member.edit', $m->id) }}">Edit</a>
            </td>
            <td>
                <form action="{{ route('member.destroy', $m->id) }}" method="post">
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