<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CategoryEditScreen extends Screen
{
    public ?Category $category = null;

    public function query(Category $category): iterable
    {
        return [
            'category' => $category,
        ];
    }

    public function name(): ?string
    {
        return $this->category?->exists
            ? 'Редактирование категории'
            : 'Создание категории';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('category.title')
                    ->title('Название категории')
                    ->required(),
            ]),
        ];
    }

    public function save(Category $category, Request $request)
    {
        $validated = $request->validate([
            'category.title' => ['required', 'string', 'max:255'],
        ]);

        $category->fill($validated['category'])->save();

        return redirect()->route('platform.categories');
    }
}