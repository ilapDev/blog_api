<?php

namespace App\Orchid\Screens;

use App\Models\Post;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class PostEditScreen extends Screen
{
    public $post;

    public function query(Post $post): iterable
    {
        return [
            'post' => $post,
        ];
    }


    public function name(): ?string
    {
        return 'Редактирование поста';
    }


    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->method('save'),

            Button::make('Удалить')
                ->method('remove')
                ->canSee($this->post?->exists),
        ];
    }


    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('post.title')
                    ->title('Заголовок')
                    ->required(),

                TextArea::make('post.text')
                    ->title('Текст')
                    ->rows(10)
                    ->required(),
            ])
        ];
    }


    public function save(Request $request, Post $post)
    {
        $request->validate([
            'post.title' => 'required',
            'post.text' => 'required',
        ]);


        $post->fill([
            'title' => $request->input('post.title'),
            'text' => $request->input('post.text'),
            'user_id' => auth()->id(),
        ]);

        $post->save();


        return redirect()
            ->route('platform.posts');
    }


    public function remove(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('platform.posts');
    }
}