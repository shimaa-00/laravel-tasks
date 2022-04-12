@extends('layouts.app')

@section('title')create post @endsection

@section('content')
<form method="POST" action="{{route('posts.store')}}" class="mt-5">
    @csrf

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">posted By</label>
        <input name="postedby" type="text" class="form-control" id="exampleFormControlInput1">
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Created At</label>
        <input name="createdat" type="text" class="form-control" id="exampleFormControlInput1">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success">Create Post</button>
    </div>
</form>
@endsection