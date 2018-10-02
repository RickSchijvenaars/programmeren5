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
    <div class="row jumbotron">

        @foreach($photos as $photo )
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img class="card-img-top" data-src="{{$photo->source}}" alt="Card image cap">
                    <div class="card-body">
                        <a class="card-title" href="/photos/{{$photo->id}}">{{$photo->name}}</a>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection