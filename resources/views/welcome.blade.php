@extends('layouts.main')

@section('content')
    <h1>Advertenties</h1>
    <ul>
        @foreach($advertisements as $advertisement )
            <li><a href="/2b/programmeren5/public/ad/{{$advertisement->id}}">{{$advertisement->name}}</a></li>
        @endforeach
    </ul>
@endsection