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
        <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
        <select name='post_creator' class="form-control">
            @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="exampleInputDate" class="form-label">Description</label>
        <input name="description" value="{{$post['description']}}" type="text" class="form-control" id="exampleInputDate">
    </div>

    <button type="submit" class="btn btn-success">update Post</button>
</form>
@endsection