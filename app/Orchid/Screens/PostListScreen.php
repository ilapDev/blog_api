<?php

namespace App\Orchid\Screens;

use App\Models\Post;
use App\Orchid\Layouts\PostListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;

class PostListScreen extends Screen
{
    public function query(): iterable
    {
        return [
                'posts' => Post::with([
                'user',
                'category'
            ])->paginate(),
        ];
    }
    public function name(): ?string
    {
        return 'Посты';
    }
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать пост')
                ->route('platform.posts.create'),
        ];
    }
    public function layout(): iterable
    {
        return [
            PostListLayout::class,
        ];
    }
    public function remove(Request $request)
    {
        Post::findOrFail($request->get('post'))->delete();

        return redirect()
            ->route('platform.posts');
    }
}