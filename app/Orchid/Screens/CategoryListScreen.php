<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use App\Orchid\Layouts\CategoryListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryListScreen extends Screen
{

    public function query(): iterable
    {
        return [
            'categories' => Category::paginate(),
        ];
    }


    public function name(): ?string
    {
        return 'Категории';
    }


    public function commandBar(): iterable
    {
        return [
            Link::make('Создать категорию')
                ->route('platform.categories.create'),
        ];
    }


    public function layout(): iterable
    {
        return [
            CategoryListLayout::class,
        ];
    }


    public function remove(Request $request)
    {
        Category::findOrFail($request->get('category'))->delete();

        return redirect()
            ->route('platform.categories');
    }
}