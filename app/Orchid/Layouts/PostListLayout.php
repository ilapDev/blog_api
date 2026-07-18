<?php

namespace App\Orchid\Layouts;

use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
{
    protected $target = 'posts';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID'),

            TD::make('title', 'Заголовок'),

            TD::make('user.name', 'Автор'),

            TD::make('category.title', 'Категория'),

            TD::make('created_at', 'Дата'),

            TD::make('actions', 'Действия')
                ->render(function (Post $post) {

                    return
                        Link::make('✏')
                            ->route('platform.posts.edit', $post->id)
                            ->class('btn btn-sm btn-primary')
                            ->render()
                        .
                        ' ' .
                        Button::make('🗑')
                            ->method('remove', [
                                'post' => $post->id
                            ])
                            ->class('btn btn-sm btn-danger')
                            ->render();

                }),
        ];
    }
}
