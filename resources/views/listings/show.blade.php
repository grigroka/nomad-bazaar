@extends('layouts.app')
<?php $titleTag = htmlspecialchars($listing->title); ?>
@section('title', "| $titleTag")

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $listing->title }}</h1>
            <h4>{{ $listing->company_name }}</h4>
            <small>{{ date('F nS, Y - G:i' ,strtotime($listing->created_at)) }}</small>
            <hr>
            <p>{{ $listing->body }}</p>
        </div>
    </div>

@endsection