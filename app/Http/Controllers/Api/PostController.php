<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;


    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }


    // Создание поста
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required'
        ]);

        $post = $this->postService->create(
            $request->all(),
            $request->user()
        );

        return response()->json($post, 201);
    }


    // Получение всех постов
    public function index(Request $request)
    {
        $posts = $this->postService->getAll(
            $request->all()
        );

        return response()->json($posts);
    }
}