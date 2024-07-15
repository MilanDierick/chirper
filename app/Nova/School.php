<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class School extends Resource
{
    public static string $model = \App\Models\School::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'city'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->required(),

            Text::make('City', 'city')
                ->sortable()
                ->rules('required', 'max:255')
                ->required(),

            Text::make('Number of Children', function () {
                return $this->children->count();
            })
                ->sortable()
                ->onlyOnIndex(),

            HasMany::make('Children', 'children', Child::class)
        ];
    }

    public function cards(Request $request): array
    {
        return [];
    }

    public function filters(Request $request): array
    {
        return [];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {
        return [];
    }
}
