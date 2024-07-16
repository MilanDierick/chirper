<?php

namespace App\Nova\Metrics;

use App\Models\Event;
use App\Models\Reservation;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Nova;

class RequestedReservations extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest  $request
     *
     * @return ValueResult
     */
    public function calculate(NovaRequest $request): ValueResult
    {
        return $this->result(Reservation::where('reservation_type_id', 1)->count());
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            30      => Nova::__('30 Days'),
            60      => Nova::__('60 Days'),
            365     => Nova::__('365 Days'),
            'TODAY' => Nova::__('Today'),
            'MTD'   => Nova::__('Month To Date'),
            'QTD'   => Nova::__('Quarter To Date'),
            'YTD'   => Nova::__('Year To Date'),
        ];
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return DateTimeInterface|null
     */
    public function cacheFor(): ?DateTimeInterface
    {
        return now()->addMinutes(5);
    }
}
