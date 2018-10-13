@extends('layouts.main')

@section('content')
    <div class="jumbotron">
            {{Auth::user()->name}}
    </div>
@endsection
