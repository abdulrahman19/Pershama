<?php

namespace App\Http\Controllers;

use App\Post;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        $this->validate(Request(), ['body'  => 'required|min:2']);

        $post->addComment(request('body'), auth()->id());

        return back();
    }
}
