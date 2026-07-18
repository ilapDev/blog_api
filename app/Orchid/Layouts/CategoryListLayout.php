<?php

namespace App\Orchid\Layouts;

use App\Models\Category;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{

    protected $target = 'categories';


    protected function columns(): iterable
    {
        return [

            TD::make('id', 'ID'),

            TD::make('title', 'Название'),


            TD::make('created_at', 'Создана'),


            TD::make('Действия')
                ->render(function(Category $category){

                    return
                        Link::make('✏')
                            ->route(
                                'platform.categories.edit',
                                $category->id
                            )
                            ->render()

                        .' '.

                        Button::make('🗑')
                            ->method('remove', [
                                'category' => $category->id,
                            ])
                            ->class('btn btn-sm btn-danger');

                }),

        ];
    }
}