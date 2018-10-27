@extends('layouts.main')

@section('content')
    <div class="jumbotron">
        {{--<form method="GET">
            <div class="form-group">
                <label for="user">Users:</label>
                <select class="form-control selectcategory smallinput" id="exampleFormControlSelect1" name="user">
                    @foreach($users as $selectuser )
                        <option>{{$selectuser->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Go</button>
            </div>
        </form>

        <form method="GET">
            <div class="form-group">
                <label for="photo">Photos:</label>
                <select class="form-control selectcategory smallinput" id="exampleFormControlSelect1" name="photo">
                    @foreach($photos as $selectphoto )
                        <option>{{$selectphoto->id}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Go</button>
            </div>
        </form>--}}

    <form method="GET">
        <select class="form-control selectcategory smallinput" id="exampleFormControlSelect1" name="edit">
            <option>Users</option>
            <option>Photos</option>
            <option>Categories</option>
        </select>
        <button type="submit" class="btn btn-primary">Go</button>
    </form>

        @if(Request::get('edit') == 'Users')
            <hr><h1>Users:</h1><hr>
            <ul>
                @foreach($users as $user )
                    <li class="lead text-muted">
                        <b>{{$user->name}}</b>
                        <form method="POST" action="/remove/{{$user->id}}" class="float-right">
                            {{ csrf_field() }}
                            <button type="submit" class="close" aria-label="Close">
                                &times;
                            </button>
                        </form>
                        <a class="btn-primary btn float-right" href="{{ route('adminedit', 'user='.$user->id) }}">Edit</a>
                        <br>
                        <p style="font-size: 0.9rem;">{{$user->email}}</p>
                    </li>
                    <hr>
                @endforeach
            </ul>

        @elseif(Request::get('edit') == 'Photos')
            <hr><h1>Photos:</h1><hr>
            <ul>
                @foreach($photos as $photo )
                    <li class="lead text-muted">
                        <b>{{$photo->name}}</b>
                        <form method="POST" action="/remove/{{$photo->id}}" class="float-right">
                            {{ csrf_field() }}
                            <button type="submit" class="close" aria-label="Close">
                                &times;
                            </button>
                        </form>

                        <a class="btn-primary btn float-right" href="{{ route('adminedit', 'photo='.$photo->id) }}">Edit</a>

                        <br>
                        <p style="font-size: 0.9rem;">{{$photo->user->name}}</p>
                    </li>
                    <hr>
                @endforeach
            </ul>

        @elseif(Request::get('edit') == 'Categories')
            <hr><h1>Categories:</h1><hr>
            <ul>
                @foreach($categories as $category )
                    <li class="lead text-muted">
                        <b>{{$category->name}}</b>
                        <form method="POST" action="/remove/{{$category->id}}" class="float-right">
                            {{ csrf_field() }}
                            <button type="submit" class="close" aria-label="Close">
                                &times;
                            </button>
                        </form>
                    </li>
                    <hr>
                @endforeach
            </ul>

        @endif
    </div>
@endsection
