@extends('layouts.app')
@section('title', '| New Listing')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Create New Listing</h1>
            <hr>
            <form action="{{ route('listings.store', Auth::user()->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input id="title" name="title" type="text"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <input id="company_name" name="company_name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="body">Description:</label>
                    <textarea id="body" name="body" class="form-control" rows="15"></textarea>
                </div>
                <input type="submit" value="Post Listing" class="btn btn-success btn-block">
            </form>
        </div>
        <div class="col-md-3">
            <div class="well">
                <h2>Create New Tag</h2>
                <form action="{{ route('tags.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <input type="submit" value="Create New Tag" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

@endsection