<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(10);


        return view('posts.index', [
            'allPosts' => $posts,
        ]);
    }

    public function create()
    {
        $users = User::all();

        //query to get all users
        return view('posts.create', [
            'users' => $users,
        ]);
    }

    public function store()
    {
        //get me the request data
        // $data = $_REQUEST; don't use plain php in laravel framework
        $data = request()->all();
        // $title = request()->title;

        //store the request data in the db
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);

        //redirect to /posts
        return to_route('posts.index');
    }

    public function show($post)
    {
        //select * from posts where id = 1
        $dbPost = Post::find($post); //App\Models\Post
        return view('posts.show', ['post' => $dbPost]);
    }

    public function edit($id)
    {
        $users = User::all();
        $dbPost = Post::find($id); //App\Models\Post
        return view('posts.edit', [
            'post' => $dbPost,
            'users' => $users,
        ]);
    }

    public function update($id, Request $request)
    {
        $post = $request->all();
        // dd($post);
        Post::find($id)->update(['title' => $post['title'], 'user_id' => $post['post_creator'], "description" => $post['description']]);

        return to_route('posts.index');
    }


    public function destroy($id)
    {
        // dd($id);
        Post::where('id', $id)->delete();
        return to_route('posts.index');
    }
}
