@extends('layouts.app')
@section('title', '| All Listings')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>All Jobs</h1>
            <small>Total jobs: {{ $listings->total() }}</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
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
            <div class="text-center">
                {{ $listings->links() }}
            </div>
        </div>
    </div>

@endsection
