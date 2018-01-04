@extends('layouts.app')
@section('title', '| All Tags')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Listings</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th>{{ $tag->id }}</th>
                        <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                        <td>{{ $tag->listings()->count() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{--Create new tag--}}
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
