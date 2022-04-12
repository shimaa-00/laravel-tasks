@extends('layouts.app')

@section('title')Edit Post @endsection

@section('content')
<form class="col-6 mx-auto my-5" method="POST" action="{{route('posts.update', $post['id'])}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleInputTitle" class="form-label">Title</label>
        <input name="title" value="{{$post['title']}}" type="text" class="form-control" id="exampleInputTitle">
    </div>


    <div class="mb-3">
        <label for="exampleInputPosted" class="form-label">Posted By</label>
        <input name="posted_by" value="{{$post['posted_by']}}" type="text" class="form-control" id="exampleInputPosted">
    </div>

    <div class="mb-3">
        <label for="exampleInputDate" class="form-label">Created At</label>
        <input name="created_at" value="{{$post['created_at']}}" type="date" class="form-control" id="exampleInputDate">
    </div>

    <button type="submit" class="btn btn-success">update Post</button>
</form>
@endsection