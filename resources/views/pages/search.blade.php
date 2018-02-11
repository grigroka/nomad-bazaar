@extends('layouts.app')
@section('title', '| Search Results')

@section('content')

    @if (count($results) === 0)
        <h4>No jobs that match your search query found.</h4>
    @elseif (count($results) >= 1)
        <h4>Total results: {{$results->count() }}</h4>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tbody>
                    @foreach($results as $listing)
                        <tr>
                            <td><img src="{{ asset('images/' . $listing->logo) }}" height="75" width="75"></td>
                            <td>
                                {{ $listing->title }}
                                <br>
                                <small>{{ $listing->company_name }}</small>
                            </td>
                            {{--TODO Make tags show in results page--}}
                            {{--<td>--}}
                                {{--<div class="tags">--}}
                                    {{--@foreach($listing->tags as $tag)--}}
                                        {{--<span class="label label-default">{{ $tag->name }}</span>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            <td>{{ date('G:i - F jS, Y' ,strtotime($listing->created_at)) }}</td>
                            <td><a href="{{ route('listings.show', $listing->id) }}" class="btn btn-default">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection