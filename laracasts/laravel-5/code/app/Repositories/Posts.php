<?php

namespace App\Repositories;

use App\Post;

class Posts
{
    public function all()
    {
        return Post::with('tags')
            ->filter(request(['month', 'year']))
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
