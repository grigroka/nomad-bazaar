@extends('layouts.app')
<?php $titleTag = htmlspecialchars($tag->name); ?>
@section('title', "| $titleTag Tag")

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $tag->name }} Tag <small>{{ $tag->listings()->count() }} Listings</small></h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary pull-right btn-block">Edit</a>
        </div>
        <div class="col-md-2">
            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                <input type="submit" value="Delete" class="btn btn-danger">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($tag->listings as $listing)
                    <tr>
                        <th>{{ $listing->id }}</th>
                        <td>{{ $listing->title }}</td>
                        <td>@foreach($listing->tags as $tag)
                                <span class="label label-default">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td><a href="{{ route('listings.show', $listing->id) }}" class="btn btn-default btn-xs">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
