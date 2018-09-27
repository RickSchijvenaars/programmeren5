@extends('layouts.main')

@section('content')
    <div class="py-5 bg-light">
        <div class="container">
            <h1>{{$photo->name}}</h1>
            <p>{{$photo->description}}</p>
        </div>
    </div>
@endsection