<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class ReservationType extends Resource
{
    public static string $model = \App\Models\ReservationType::class;

    public static $title = 'type';

    public static $search = [
        'id', 'type'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Type', 'type')
                ->sortable()
                ->rules('required')
                ->required(),

            HasMany::make('Reservations', 'reservations', Reservation::class)
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
