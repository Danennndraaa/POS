<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
     <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>Username</td>
            <td>nama</td>
            <td>Password</td>
            <td>Level ID</td>
        </tr>
        @foreach($data as $d)
            <tr>
                <td>{{ $d->username }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->password }}</td>
                <td>{{ $d->level_id }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>