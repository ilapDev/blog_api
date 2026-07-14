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

    public function getAll(array $params)
    {
        $limit = $params['limit'] ?? 10;
        $offset = $params['offset'] ?? 0;
        $sort = $params['sort'] ?? 'created_at';

        if (!in_array($sort, ['created_at', 'title'])) {
            $sort = 'created_at';
        }
        
        return Post::with('user')
            ->orderBy($sort, 'desc')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }
}