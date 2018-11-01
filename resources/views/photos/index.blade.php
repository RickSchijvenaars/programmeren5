@extends('layouts.main')

@section('content')
    <div class="row justify-content-end">
        <form method="GET" style="float:right;" class="mr-3">
            <div class="form-group">
                <select onChange="this.form.submit()" class="form-control smallinput" id="categorySearch" name="category">
                    <option>Category..</option>
                    <option>All</option>
                    @foreach($categories as $category )
                        <option>{{$category->name}}</option>
                    @endforeach
                    @include('layouts.errors')
                </select>
            </div>
        </form>

        <form method="GET" style="float:right;">
            <div class="form-group">
                <input type="text" class="mr-1 form-control smallinput d-inline-block" name="search" id="freeSearch" placeholder="Search">
                <button type="submit" class="btn-primary btn float-right">Go</button>
            </div>
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
{{----}}
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