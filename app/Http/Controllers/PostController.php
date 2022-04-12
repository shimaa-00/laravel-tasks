<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $posts;

    public function __construct()
    {
        $this->posts = [
            ['id' => 1, 'title' => 'first post', 'posted_by' => 'Shimaa', 'created_at' => '2022-04-10'],
            ['id' => 2, 'title' => 'second post', 'posted_by' => 'Zahraa', 'created_at' => '2022-03-18']
        ];
    }
    public function index()
    {

        return view('posts.index', ['allPosts' => $this->posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $postData = request()->all();

        $post = [
            "id" => count($this->posts) + 1,
            "title" => request()["title"],
            "posted_by" => request()['postedby'],
            "created_at" => request()['createdat']
        ];


        array_push($this->posts, $post);
        return view('posts.index', ['allPosts' => $this->posts]);
    }

    public function show($id)
    {
        $id = (int)$id;
        $filteredPost = array_filter($this->posts, function ($post) use ($id) {
            return $post["id"] === $id;
        });
        if ($filteredPost) {
            return view('posts.show', [
                "filteredPost" => $filteredPost
            ]);
        } else

            return abort(404);
    }

    public function edit($id)
    {


        foreach ($this->posts as $p) {
            if ($p['id'] == $id) {
                return view('posts.edit', ['post' => $p]);
            }
        }
        return abort(404);
    }

    public function update($id, Request $request)
    {

        $post = $request->all();

        foreach ($this->posts as $p) {
            if ($p['id'] == $id) {
                $p = $request->all();
                break;
            }
        }

        // dd($this->posts);

        $this->posts[$id - 1] = $post;

        return view('posts.index', ['allPosts' => $this->posts]);
    }


    public function destroy($id)
    {

        unset($this->posts[$id - 1]);

        return view('posts.index', ['allPosts' => $this->posts]);
    }
}
