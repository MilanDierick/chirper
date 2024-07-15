<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;

class Reservation extends Resource
{
    public static string $model = \App\Models\Reservation::class;

    public static $title = 'id';

    public static $search = [
        'id', 'child_id', 'event_id'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Type', 'reservationType', ReservationType::class)
                     ->filterable()
                     ->required(),

            BelongsTo::make('Child', 'child', Child::class)
                     ->withSubtitles()
                     ->searchable(),

            BelongsTo::make('Event', 'event', Event::class)
                     ->withSubtitles()
                     ->searchable(),
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
