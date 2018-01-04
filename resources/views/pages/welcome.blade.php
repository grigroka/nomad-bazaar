@extends('layouts.app')
@section('title', '| Welcome')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Welcome to Nomad Bazaar!</h1>
                <p>Find the best remote workers all around the world.</p>
                <a class="btn btn-primary btn-lg" href="{{ route('listings.create') }}" role="button">Add Listing</a>
                <a class="btn btn-primary btn-lg" href="{{ route('listings.index') }}" role="button">View All</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>Newest jobs:</thead>
                <tbody>
                @foreach($listings as $listing)
                    <tr>
                        <td>Logo</td>
                        <td>
                            {{ $listing->title }}
                            <br>
                            <small>{{ $listing->company_name }}</small>
                        </td>
                        <td>
                            <div class="tags">
                                @foreach($listing->tags as $tag)
                                    <span class="label label-default">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td>{{ date('G:i - F jS, Y' ,strtotime($listing->created_at)) }}</td>
                        <td><a href="{{ route('listings.show', $listing->id) }}" class="btn btn-default">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection