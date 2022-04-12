@extends('layouts.app')

@section('title') View post @endsection

@section('content')
@foreach ($filteredPost as $post)
<div class="card my-5">
    <div class="card-header"> Post info </div>
    <div class="card-body">
        <h5 class="card-title">Title : {{$post['title']}} </h5>
    </div>
</div>

<div class="card">
    <div class="card-header"> Post creator info </div>
    <div class="card-body">
        <h5 class="card-title">Name : {{$post['posted_by']}}</h5>
        <h5 class="card-title">Created at : {{$post['created_at']}}</h5>
    </div>
</div>
@endforeach
@endsection