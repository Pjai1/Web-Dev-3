@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    <p>Welcome to the Mobile Vikings Contest Website!</p>
                    <div>  
                    <br />
                    <p>Our winners are</p>
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>                       
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>  
                    </table>  
                    </div>
                    <br />
                    <p>Since you are logged in you can <a href="{{ url('/contest') }}">opt-in</a> our contest!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
