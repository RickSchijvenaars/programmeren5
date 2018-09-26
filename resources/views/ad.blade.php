@extends('layouts.main')

@section('content')
<h1>{{$advertisement->name}}</h1>
<p>{{$advertisement->description}}</p>
Prijs: €{{$advertisement->price}}
@endsection