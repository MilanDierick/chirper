@props(['status'])

@php
    $statusColors = [
        'request' => 'bg-yellow-200 text-yellow-800',
        'open' => 'bg-green-200 text-green-800',
        'waitlist' => 'bg-orange-200 text-orange-800',
        'full' => 'bg-red-200 text-red-800',
        'cancelled' => 'bg-gray-200 text-gray-800',
    ];

    $statusText = [
        'request' => 'Request',
        'open' => 'Open',
        'waitlist' => 'Waitlist',
        'full' => 'Full',
        'cancelled' => 'Cancelled',
    ];
@endphp

<span class="px-2.5 py-0.5 rounded text-2xl font-semibold {{ $statusColors[$status] ?? 'bg-gray-200 text-gray-800' }} z-20">
    {{ $statusText[$status] ?? 'Unknown' }}
</span>
