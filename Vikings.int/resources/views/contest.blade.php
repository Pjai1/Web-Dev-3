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

                    @if (session('status'))
                        {{ session('status') }}
                    @else
                    <form action="{{ url('entry/') }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="period_id" class="control-label">Period</label>

                            <div>
                                <input type="text" name="period_id" id="period_id" class="form-control" value="{{$currentPeriod->id}}">
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary">Enter Contest</button>
                    </form>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection