<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\Posts;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Posts $posts)
    {
        $posts = $posts->all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // $this->validate(Request(), [
        //     'title' => 'required',
        //     'body'  => 'required',
        // ]);

        // $request->doSomestaff();

        // $post = new Post;
        // $post->title = Request('title');
        // $post->body = Request('body');
        // $post->save();

        // Post::create(Request(['title', 'body']));

        // auth()->user()->publish(Request(['title', 'body'])); << for save

        // $tags = $post->tags()->attach($tag); << to save a post tags
        // $tags = $post->tags()->detach($tag); << to remove a post tags

        auth()->user()->publish(new Post(Request(['title', 'body']))); // << for create

        session()->flash('message', 'The post published');

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $post must be the same name on route file.
        // $archive = Post::archives();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
