@extends('layouts.app')
<?php $titleTag = htmlspecialchars($listing->title); ?>
@section('title', "| Edit $titleTag")

@section('stylesheets')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({
            selector:'#body',
            plugins: 'link',
            menubar: false
        });</script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Edit Listing</h1>
            <hr>
            <form action="{{ route('listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <textarea id="title" name="title" class="form-control">{{ $listing->title }}</textarea>
                </div>
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <textarea id="company_name" name="company_name" class="form-control">{{ $listing->company_name }}</textarea>
                </div>
                <div class="form-group">
                    <label for="logo">Update Company Logo:</label>
                    <input id="logo" name="logo" type="file">
                </div>
                <div class="form-group">
                    <label for="tags">Tags:</label>
                    {{--Add [] in select name atribute to get array of multiple selects instead of sum of selects (default)--}}
                    <select name="tags[]" id="tags" multiple="multiple" class="form-control">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @foreach($listing->tags as $selectedTags) @if($tag->id == $selectedTags->id)selected="selected"@endif @endforeach>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <small>CTRL + Click to select multiple</small>
                </div>
                <div class="form-group">
                    <label for="body">Description:</label>
                    <textarea id="body" name="body" class="form-control" rows="15">{{ $listing->body }}</textarea>
                </div>
                <input type="submit" value="Save Changes" class="btn btn-success btn-block">
                {{--HTML forms don't support PUT, PATCH, DELETE. Using hidden fields to spoof required method.--}}
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>

@endsection