<?php

namespace App\Nova;

use App\Nova\Metrics\RequestedReservations;
use App\Nova\Metrics\SpotsTaken;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

/**
 * @property string $title
 * @property string $address
 */
class Event extends Resource
{
    public static string $model = \App\Models\Event::class;

    public static $search = [
        'id',
        'title',
        'address',
        'mail_subject',
        'mail_body',
        'classes',
        'sorting'
    ];

    public static $with = ['author'];

    public function title(): string
    {
        return $this->title;
    }

    public function subtitle(): string
    {
        return $this->address;
    }

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Title', 'title')
                ->sortable()
                ->rules('required'),

            Markdown::make('Description', 'description')
                    ->sortable()
                    ->rules('nullable'),

            Text::make('Prerequisites', 'prerequisites')
                ->hideFromIndex()
                ->rules('nullable'),

            Number::make('Spots', 'spots')
                  ->sortable()
                  ->rules('required', 'integer'),

            Number::make('Spots Taken', 'spots_taken')
                  ->sortable()
                  ->rules('required', 'integer'),

            Number::make('Waitlist', 'waitlist')
                  ->sortable()
                  ->rules('required', 'integer'),

            Number::make('Waitlist Taken', 'waitlist_taken')
                  ->sortable()
                  ->rules('required', 'integer'),

            Select::make('Status', 'status_id')
                  ->options([
                      1 => 'Request',
                      2 => 'Open',
                      3 => 'Waitlist',
                      4 => 'Full',
                      5 => 'Cancelled',
                  ])
                  ->sortable()
                  ->rules('required'),

            DateTime::make('Start', 'start')
                    ->sortable()
                    ->rules('required', 'date'),

            DateTime::make('End', 'end')
                    ->sortable()
                    ->rules('required', 'date'),

            DateTime::make('Grace', 'grace')
                    ->sortable()
                    ->rules('required', 'date'),

            Text::make('Address', 'address')
                ->sortable()
                ->rules('required'),

            Text::make('Mail Subject', 'mail_subject')
                ->hideFromIndex()
                ->sortable()
                ->rules('required'),

            Markdown::make('Mail Body', 'mail_body')
                    ->hideFromIndex()
                    ->sortable()
                    ->rules('required'),

            BelongsToMany::make('Class Levels', 'classLevels', ClassLevel::class)
                         ->filterable()
                         ->sortable()
                         ->rules('required'),

            BelongsTo::make('Author', 'author', User::class)
                     ->filterable()
                     ->searchable()
                     ->sortable()
                     ->rules('required'),

            HasMany::make('Reservations', 'reservations', Reservation::class),

            Image::make('Image')
                 ->disk('public')
                 ->path('event_images')
                 ->rules('nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'),
        ];
    }

    public function cards(Request $request): array
    {
        return [
            new SpotsTaken,
            new RequestedReservations,
        ];
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
