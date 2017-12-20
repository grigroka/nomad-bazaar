@extends('layouts.app')
@section('title', '| Homepage')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>All Listings</h1>
            <small>Total listings: {{ $listings->count() }}</small>

        </div>

        <div class="col-md-2">
            <a href="{{ route('listings.create') }}" class="btn btn-lg btn-block btn-primary">New Listing</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    @foreach($listings as $listing)
        <div class="panel">
            <div class="col-md-12">
                <div class="col-md-6 panel-heading">
                    <h1>{{ $listing->title }}</h1>
                    <h5>{{ $listing->company_name }}</h5>
                    <small>{{ date('F nS, Y - G:i' ,strtotime($listing->created_at)) }}</small>
                    <br>
                    <a href="{{ route('listings.show', $listing->id) }}" class="btn btn-default">View</a>
                    <a href="{{ route('listings.edit', $listing->id) }}" class="btn btn-success">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
                </div>
                <div class="col-md-6 panel-body">
                    <p>{{ substr(strip_tags($listing->body), 0, 700) }} {{ strlen(strip_tags($listing->body)) > 700 ? "..." : "" }}</p>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
