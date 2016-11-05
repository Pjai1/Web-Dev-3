@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contest</div>

                <div class="panel-body">
                    <p>You can join the contest by clicking on the button below.<p>
                    <br />

                    @foreach($entries as $entry)
                        @if($entry->user_id == Auth::user()->id && $currentPeriod->id == $entry->period_id)
                            <p>Thanks for participating {{Auth::user()->name}}, please check your email!</p>
                            @break      
                        @else
                                                <form action="{{ url('entry/') }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <!-- <label for="period_id" class="control-label">Period</label> -->
                                <input type="hidden" name="period_id" id="period_id" class="form-control" value="{{$currentPeriod->id}}">
                        </div>
                            <button type="submit" class="btn btn-primary">Enter Contest</button>
                    </form> 
                    @break
                    @endif
                    @endforeach     


            </div>
        </div>
    </div>
</div>
@endsection