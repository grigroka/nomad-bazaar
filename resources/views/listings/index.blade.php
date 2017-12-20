@extends('layouts.app')
@section('title', '| All Listings')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>All Listings</h1>
            <small>Total listings: {{ $listings->count() }}</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tbody>
                {{--@foreach($listings as $listing)--}}
                <tr>
                    <td>Logo</td>
                    <td>
                        Listing Name
                        <br>
                        <small>Company Name</small>
                    </td>
                    <td>Tags</td>
                    <td>Added Time</td>
                </tr>
                {{--@endforeach--}}
                </tbody>
            </table>
            <div class="text-center">
                {{ $listings->links() }}
            </div>
        </div>
    </div>

@endsection