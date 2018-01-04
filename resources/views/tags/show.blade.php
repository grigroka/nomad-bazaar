@extends('layouts.app')
<?php $titleTag = htmlspecialchars($tag->name); ?>
@section('title', "| $titleTag Tag")

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $tag->name }} <small>{{ $tag->listings()->count() }} Listings</small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Tags</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($tag->listings as $listing)
                    <tr>
                        <td>{{ $listing->title }}</td>
                        <td>@foreach($listing->tags as $tag)
                                <span class="label label-default">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td><a href="{{ route('listings.show', $listing->id) }}" class="btn btn-default btn-sm">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
