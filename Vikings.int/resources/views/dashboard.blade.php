@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Welcome to the Admin Dashboard!</p>

                    <p>Users</p>
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>                       
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->isAdmin}}</td>
                                <td>
                                @if ($user->deleted_at == NULL)
                                    <form action="{{ url('/user/'.$user->id) }}" method="POST">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                @else
                                    <form action="{{ url('user/restore/'.$user->id) }}" method="POST">
                                        {!! csrf_field() !!}

                                        <button type="submit" class="btn btn-primary">Restore</button>
                                    </form>

                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>  
                    </table> 
                        <form action="{{ url('/exportusers') }}" method="GET">
                            <button>Get User Excel</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection