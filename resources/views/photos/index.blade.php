@extends('layouts.main')

@section('content')
    <div class="row justify-content-end">
    <form method="GET" style="float:right;">
        <select class="form-control selectcategory smallinput" id="exampleFormControlSelect1" name="category">
            <option>All</option>
            @foreach($categories as $category )
                <option>{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    </div>
    <div class="row">

        @foreach($photos as $photo )
            <div class="col-md-3">
                <a style="text-decoration: none;" href="{{ route('details', ['photo' => $photo->id])}}">
                    <div class="card photocard shadow-sm smallphotocontainer" style="background-image:url('/photos/{{$photo->source}}');">
                        @if (Auth::user() && Auth::user()->type == 'admin')
                        <span class="photoid">{{$photo->id}}</span>
                        @endif
{{--
                        <img class="card-img-top" src="/photos/{{$photo->source}}" alt="Photo">
--}}
                        <div class="card-body card-info">
                            <span class="card-title photocard-title">{{$photo->name}}</span>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $photo->created_at->toFormattedDateString()  }}</small>
                                <small class="text-muted">{{ $photo->user->name  }}</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
@endsection