<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function create(array $data, $user)
    {
        $post = Post::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'user_id' => $user->id
        ]);

        return $post;
    }
}