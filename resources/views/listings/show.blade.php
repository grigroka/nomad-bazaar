@extends('layouts.app')
<?php $titleTag = htmlspecialchars($listing->title); ?>
@section('title', "| $titleTag")

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $listing->title }}</h1>
            <h4>{{ $listing->company_name }}</h4>
            <small>{{ date('F jS, Y - G:i' ,strtotime($listing->created_at)) }}</small>
            <div class="tags">
                @foreach($listing->tags as $tag)
                    <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
            </div>
            <hr>
            {{--TODO After implementing editor make body output HTML from DB. Use purifier to clean data before store fucntion.--}}
            <p>{{ $listing->body }}</p>
        </div>
    </div>

@endsection