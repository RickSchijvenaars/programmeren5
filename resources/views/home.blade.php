@extends('layouts.main')

@section('content')
<main role="main">

    <div class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Frickr</h1>
            <br><hr>
            <p class="lead text-muted"><i>"Photography is the story we fail to put into words."</i></p>
            <hr><br>
        </div>
        <a class="btn-primary btn" href="{{route('photos')}}">Album</a>
        <a class="btn-secondary btn" href="{{route('upload')}}">Upload</a>
    </div>

</main>
@endsection