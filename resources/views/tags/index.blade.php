@extends('layouts.app')
@section('title', '| All Tags')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Listings</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                        <td>{{ $tag->listings()->count() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
