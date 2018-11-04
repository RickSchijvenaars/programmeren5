@extends('layouts.main')

@section('content')
    <div class="jumbotron">

    <form method="GET">
        <select class="form-control selectcategory smallinput" id="exampleFormControlSelect1" name="edit">
            <option>Users</option>
            <option>Photos</option>
            <option>Categories</option>
        </select>
        <button type="submit" class="btn btn-primary">Go</button>
    </form>

        @if(Request::get('edit') == 'Users')
            <span class="alert-danger">Beware, deleting a user will also delete the user's photos and comments.</span>
            <hr><h1>Users:</h1>
            <span class="float-right text-muted" style="margin-top: -15px;margin-right: 5px;">Admin:</span>
            <hr>
            <ul>
                @foreach($users as $user )
                    <li class="lead text-muted">
                        <b>{{$user->name}}</b>

                        <form method="POST" action="{{ route('updaterole', ['id' => $user->id])}}" class="float-right">
                            {{ csrf_field() }}
                            <label class="switch">
                                <input name="role" onChange="this.form.submit()" type="checkbox" @if($user->type == 'admin') checked @endif>
                                <span class="slider"></span>
                            </label>
                        </form>

                        <form method="POST" action="{{ route('deleteuser', ['id' => $user->id])}}" class="float-right">
                            {{ csrf_field() }}
                            <button type="submit" class="btn-primary btn float-right bg-danger border-danger adminbtn">Delete</button>
                        </form>

                        <form method="POST" action="{{ route('adminedituser', [ 'id' => $user->id])}}" class="float-right">
                            {{ csrf_field() }}
                            <button type="submit" class="btn-primary btn float-right adminbtn">Edit</button>
                        </form>
                       {{-- <a class="btn-primary btn float-right" href="{{ route('adminedit', 'user='.$user->id) }}">Edit</a>
--}}
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
                        <img class="" style="width:auto;max-height:60px;margin-top:-10px;" src="/photos/{{$photo->source}}" alt="Photo">
                        | <b>{{$photo->name}}</b>
                        <span style="font-size: 0.9rem;">(By <i><b>{{$photo->user->name}}</b></i>)</span>
                        <form method="POST" action="{{ route('deletephoto', ['id' => $photo->id])}}" class="float-right">
                            {{ csrf_field() }}
                            <button type="submit" class="btn-primary btn float-right bg-danger border-danger adminbtn">Delete</button>
                        </form>
                        <form method="POST" action="{{ route('admineditphoto', [ 'id' => $photo->id])}}" class="float-right">
                            {{ csrf_field() }}
                            <button type="submit" class="btn-primary btn float-right adminbtn">Edit</button>
                        </form>
                       {{-- <a class="btn-primary btn float-right" href="{{ route('admineditphoto', 'photo='.$photo->id) }}">Edit</a>--}}

                        <br>
                    </li>
                    <hr>
                @endforeach
            </ul>

        @elseif(Request::get('edit') == 'Categories')
            <span class="alert-danger">Beware, deleting a category will also delete the photos and comments in this category.</span>
            <hr><h1>Categories:</h1><hr>
            <form method="POST" action="{{route('addcategory')}}">
                {{ csrf_field() }}
                <h5>Add category</h5>
                <div class="form-group">
                    <input type="text" class="form-control smallinput selectcategory" name="category" placeholder="New category">

                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>

            <ul>
                @foreach($categories as $category )
                    <li class="lead text-muted">
                        <b>{{$category->name}}</b> (<b>{{$category->amount_photos}}</b>)
                        <form method="POST" action="{{ route('deletecategory', ['id' => $category->id])}}" class="float-right">
                            {{ csrf_field() }}
                            <button type="submit" class="btn-primary btn float-right bg-danger border-danger adminbtn">Delete</button>
                        </form>
                    </li>
                    <hr>
                @endforeach
            </ul>

        @endif
    </div>
@endsection
