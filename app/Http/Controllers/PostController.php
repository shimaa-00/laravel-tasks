<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Validation\Rule;


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
        //validate the data
        request()->validate([
            'title' => ['required', 'min:3', 'unique:posts'],
            'description' => ['required', 'min:10'],
            'post_creator' => ['required', 'exists:users,id']
        ]);

        $data = request()->all();
        // dd($data);
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
        // dd($dbPost);
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
        request()->validate([

            'title' => ['required', Rule::unique('posts')->ignore(Post::find($id)), 'min:3'],
            'description' => ['required', 'min:10'],
            'post_creator' => ['required', 'exists:users,id']
        ]);
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
