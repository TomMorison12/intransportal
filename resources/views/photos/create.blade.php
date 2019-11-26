@extends('layouts.app')

@section('content')
<h1>Upload new photo</h1>
    <form method="post" action="{{ route('photos.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
    Title <input type="text" name="title" class="form-control" />
        File: <input type="file" name="thumbnail" class="form-control" />
        Description <textarea name="body" class="form-control"></textarea>
    <input type="submit" name="submit" class="btn btn-primary" />

@endsection
