<!DOCTYPE html>
<html>
    <head>
        <title>Excel Sheet of Entries</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>User Id</th>
                    <th>Period Id</th>
                    <th>Key</th>
                    <th>IP</th>
                    <th>Lost0_Won1</th>
                    <th>Deleted_At</th>
                    <th>Created_At</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entries as $entry)
                    <tr>
                        <td>{{$entry->id}}</td>
                        <td>{{$entry->user_id}}</td>
                        <td>{{$entry->period_id}}</td>
                        <td>{{$entry->key}}</td>
                        <td>{{$entry->ip}}</td>
                        <td>{{$entry->isWinningEntry}}</td>
                        <td>{{$entry->deleted_at}}</td>
                        <td>{{$entry->created_at}}</td>
                        <td>{{$entry->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>