<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;

class ClassLevel extends Resource
{
    public static string $model = \App\Models\ClassLevel::class;

    public static $title = 'id';

    public static $search = [
        'id', 'level'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Number::make('Level', 'level')
                  ->sortable()
                  ->rules('required')
                  ->required(),

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
