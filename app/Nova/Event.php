<?php

namespace App\Nova;

use App\Nova\Metrics\SpotsTaken;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Number;
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

            MultiSelect::make('Classes', 'classes')
                       ->filterable()
                       ->sortable()
                       ->rules('required')
                       ->options([
                           'Class 1'  => 'Class 1',
                           'Class 2'  => 'Class 2',
                           'Class 3'  => 'Class 3',
                           'Class 4'  => 'Class 4',
                           'Class 5'  => 'Class 5',
                           'Class 6'  => 'Class 6',
                           'Class 7'  => 'Class 7',
                           'Class 8'  => 'Class 8',
                           'Class 9'  => 'Class 9',
                           'Class 10' => 'Class 10',
                           'Class 11' => 'Class 11',
                           'Class 12' => 'Class 12',
                       ]),

            Text::make('Sorting', 'sorting')
                ->hideFromIndex()
                ->readonly()
                ->rules('required'),

            BelongsTo::make('Author', 'author', User::class)
                     ->filterable()
                     ->searchable()
                     ->sortable()
                     ->rules('required'),

            HasMany::make('Reservations', 'reservations', Reservation::class),
        ];
    }

    public function cards(Request $request): array
    {
        return [
            new SpotsTaken
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
