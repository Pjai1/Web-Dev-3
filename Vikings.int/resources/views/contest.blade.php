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

                    <form action="{{ url('/error') }}" method="GET" class="form-horizontal">
                        <!-- {!! csrf_field() !!} -->
                            <button type="button" class="btn btn-primary">Enter Contest</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection