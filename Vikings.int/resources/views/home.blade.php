@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    <h2>Welcome to the Mobile Vikings Contest Website!</h2>
                    <div>
                    @if($currentPeriod)  
                    <h3>Our Winners for {{$currentPeriod->name}}</h3> 
                        @foreach ($entryWinners as $winner)
                            @if ($currentPeriod->id == $winner->period_id && $winner->isWinningEntry == 1)
                                <ul>
                                    <li>{{$winner->user->name}}</li>
                                </ul>
                            @endif
                        @endforeach
                    </div>
                    <br />
                    <p>Since you are logged in you can <a href="{{ url('/contest') }}">opt-in</a> our contest!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
