<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

/**
 * @property string $last_name
 * @property string $first_name
 * @property \App\Models\User $parent
 */
class Child extends Resource
{
    public static string $model = \App\Models\Child::class;

    public static $search = [
        'id', 'last_name', 'first_name', 'information'
    ];

    public static $with = ['parent'];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Last Name', 'last_name')
                ->sortable()
                ->rules('required')
                ->required(),

            Text::make('First Name', 'first_name')
                ->sortable()
                ->rules('required')
                ->required(),

            Date::make('Date Of Birth', 'date_of_birth')
                ->sortable()
                ->rules('required', 'date')
                ->required(),

            BelongsTo::make('ClassLevel', 'classLevel', ClassLevel::class)
                     ->required(),

            Text::make('Information', 'information')
                ->sortable(),

            Boolean::make('Special Needs', 'special_needs')
                   ->sortable(),

            Boolean::make('Media Consent', 'media_consent')
                   ->sortable(),

            BelongsTo::make('Parent', 'parent', User::class)
                     ->searchable()
                     ->required(),

            BelongsTo::make('School Type', 'schoolType', SchoolType::class)
                     ->required(),

            BelongsTo::make('School', 'school', School::class)
                     ->showCreateRelationButton()
                     ->searchable()
                     ->required(),

            HasMany::make('Reservations', 'reservations', Reservation::class),
        ];
    }

    public function title(): string
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function subtitle(): string
    {
        return $this->parent->full_name;
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
