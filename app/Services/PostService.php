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
            'user_id' => $user->id,
            'category_id' => $data['category_id'] ?? null
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
        
        return Post::with([
            'user',
            'category'
        ])
        ->orderBy($sort, 'desc')
        ->limit($limit)
        ->offset($offset)
        ->get();
    }

    public function getMyPosts(array $params, $user)
    {
        $limit = $params['limit'] ?? 10;
        $offset = $params['offset'] ?? 0;
        $sort = $params['sort'] ?? 'created_at';

        if (!in_array($sort, ['created_at', 'title'])) {
            $sort = 'created_at';
        }

        $query = Post::with([
                'category'
            ])
            ->where('user_id', $user->id);

        if (!empty($params['date_from'])) {
            $query->whereDate(
                'created_at',
                '>=',
                $params['date_from']
            );
        }

        if (!empty($params['date_to'])) {
            $query->whereDate(
                'created_at',
                '<=',
                $params['date_to']
            );
        }

        return $query
            ->orderBy($sort, 'desc')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }
}