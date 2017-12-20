@extends('layouts.app')
<?php $titleTag = htmlspecialchars($listing->title); ?>
@section('title', "{{ $titleTag }}")

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $listing->title }}</h1>
            <small>Company name: {{ $listing->company_name }}</small>
            <hr>
            <p>{{ $listing->body }}</p>
        </div>
    </div>

@endsection