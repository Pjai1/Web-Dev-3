<!DOCTYPE html>
<html>
    <head>
        <title>Excel Sheet of Periods</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Deleted_At</th>
                    <th>Created_At</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periods as $period)
                    <tr>
                        <td>{{$period->id}}</td>
                        <td>{{$period->name}}</td>
                        <td>{{$period->startDate}}</td>
                        <td>{{$period->endDate}}</td>
                        <td>{{$period->deleted_at}}</td>
                        <td>{{$period->created_at}}</td>
                        <td>{{$period->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>