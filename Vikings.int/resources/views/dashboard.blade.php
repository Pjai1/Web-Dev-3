@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Welcome to the Admin Dashboard!</p>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>User Management</h1>
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Admin/User</th>
                                <th>Delete/Restore</th>
                            </tr>
                        </thead>
                        <tbody>                       
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                @if($user->isAdmin)
                                    <form action="{{ url('user/update/'.$user->id) }}" method="POST">
                                        {!! csrf_field() !!}

                                        <button type="submit" class="btn btn-primary" @if ($user->deleted_at != NULL) disabled @endif>Make User</button>
                                    </form>
                                @else
                                    <form action="{{ url('user/update/'.$user->id) }}" method="POST">
                                        {!! csrf_field() !!}

                                        <button type="submit" class="btn btn-primary" @if ($user->deleted_at != NULL) disabled @endif>Make Admin</button>
                                    </form>
                                @endif            
                                </td>
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
                        <form action="{{ url('/exportusers/') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Get User Excel</button>
                        </form>


                    <br />    
                    <h1>Period Management</h1>
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Winning Key</th>
                                <th>Delete/Restore</th>
                            </tr>
                        </thead>
                        <tbody>                       
                            @foreach ($periods as $period)
                            <tr>
                                <td>{{$period->name}}</td>
                                <td>{{$period->startDate}}</td>
                                <td>{{$period->endDate}}</td>
                                <td>{{$period->winningKey}}</td>
                                <td>
                                @if ($period->deleted_at == NULL)
                                    <form action="{{ url('/period/'.$period->id) }}" method="POST">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                @else
                                    <form action="{{ url('period/restore/'.$period->id) }}" method="POST">
                                        {!! csrf_field() !!}

                                        <button type="submit" class="btn btn-primary">Restore</button>
                                    </form>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>  
                    </table> 
                        <form action="{{ url('/exportperiods') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Get Period Excel</button>
                        </form>    

                    <br />
                    <h2>Period Creation</h2>
                    <form action="{{ url( 'period/' ) }}" method="POST" class="form-inline">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>

                            <div>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Periode 1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="startDate" class="control-label">Start Date</label>

                            <div>
                                <input type="text" name="startDate" id="startDate" class="form-control" placeholder="2016-10-02 00:00:00">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="endDate" class="control-label">End Date</label>

                            <div>
                                <input type="text" name="endDate" id="endDate" class="form-control" placeholder="2016-10-02 00:00:00">
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="padding-top:24px;">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>

                    <br />    
                    <h1>Entry Management</h1>
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Period</th>
                                <th>Key</th>
                                <th>IP</th>
                                <th>Delete/Restore</th>
                            </tr>
                        </thead>
                        <tbody>                       
                            @foreach ($entries as $entry)
                            <tr>
                                <td>{{$entry->user->name}}</td>
                                <td>{{$entry->period->name}}</td>
                                <td>{{$entry->key}}</td>
                                <td>{{$entry->ip}}</td>
                                <td>
                                @if ($entry->deleted_at == NULL)
                                    <form action="{{ url('/entry/'.$entry->id) }}" method="POST">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                @else
                                    <form action="{{ url('entry/restore/'.$entry->id) }}" method="POST">
                                        {!! csrf_field() !!}

                                        <button type="submit" class="btn btn-primary">Restore</button>
                                    </form>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>  
                    </table> 
                        <form action="{{ url('/exportentries') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Get Entry Excel</button>
                        </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection