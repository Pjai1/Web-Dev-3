<!DOCTYPE html>
<html>
    <head>
        <title>Excel Sheet of Users</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>IsAdmin</th>
                    <th>IP</th>
                    <th>Deleted_At</th>
                    <th>Created_At</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td>{{$user->isAdmin}}</td>
                        <td>{{$user->ip}}</td>
                        <td>{{$user->deleted_at}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>