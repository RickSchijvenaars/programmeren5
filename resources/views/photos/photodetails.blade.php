@extends('layouts.main')

@section('content')
    <div class="py-5 bg-light">
        <div class="jumbotron container" style="flex-wrap: wrap;display:flex;">
            <div>
                <img class=" bigphotocontainer" src="/photos/{{$currentphoto->source}} ">
            </div>

            <div class="photoparagraph">
                <h1 style="margin-top:20px;">{{$currentphoto->name}}</h1>
                <p class="text-muted">
                    <i>By <b>{{$currentphoto->user->name}}</b> | {{ $currentphoto->created_at->toFormattedDateString()  }}</i>
                </p>
                <p>{{$currentphoto->description}}</p>
            </div>

        </div>

        <hr>
        <div class="container">
            <h3>Comments:</h3>
        @foreach ($currentphoto->comments as $comment)
                <div class="row">
                <div class="col">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>{{$comment->user->name}}</strong><span class="text-muted"> | {{$comment->created_at->diffForHumans()}}:</span>
                        </div>
                        <div class="panel-body">
                            {{$comment->body}}
                        </div>
                    </div>
                </div>
                </div>
            @endforeach
        </div>

        <hr>

        @guest
            <div class="container">
                <form>
                    {{csrf_field()}}
                    <div class="form-group">
                        <strong><label>You have to be logged in to post a comment.</label></strong>
                        <textarea name="body" class="form-control" style="max-width: 500px;"  disabled></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" disabled>Add</button>

                    </div>

                </form>
            </div>
        @else
            <div class="container">
                <form method="POST" action="{{ route('comment', ['photo' => $currentphoto->id])}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <strong><label>Your comment:</label></strong>
                        <textarea name="body" class="form-control" style="max-width: 500px;" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>

                    </div>

                </form>

                @include('layouts.errors')

            </div>
        @endguest

    </div>
@endsection