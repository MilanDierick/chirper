<a href="{{ route('events.show', $event) }}" class="block bg-white overflow-hidden shadow-xl sm:rounded-lg hover:shadow-2xl transition duration-300 border border-transparent hover:border-gray-300">
    <div class="relative" style="padding-top: 56.25%; overflow: hidden; position: relative;">
        <img src="{{ $event->image_url ?? 'https://placehold.co/800x800' }}" alt="{{ $event->title }}" class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg">
    </div>
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>
        <div class="flex flex-wrap gap-2 mb-4">
            <span class="bg-gray-200 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded"><i class="far fa-calendar-alt mr-1"></i>{{ $event->start->format('d.m.Y') }} - {{ $event->end->format('d.m.Y') }}</span>
            <span class="bg-blue-200 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $event->getClassRangeAttribute() }}</span>
        </div>
        <p class="text-gray-600 text-sm">{{ Str::limit($event->long_description, 100) }}</p>
    </div>
</a>
