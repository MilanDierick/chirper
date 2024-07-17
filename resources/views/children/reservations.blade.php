<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-3xl font-semibold mb-6">{{ $child->first_name }} {{ $child->last_name }} - Reservations</h1>
        @foreach($reservations as $reservation)
            <div class="block bg-white shadow overflow-hidden sm:rounded-lg p-6 hover:bg-gray-50 transition duration-300 mb-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $reservation->event->title }}</h2>
                    <div class="relative">
                        <button class="relative z-10 block bg-white p-2 rounded-md focus:outline-none">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m-6-6h6m6 0h-6"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl">
                            <form method="POST" action="{{ route('reservations.destroy', $reservation) }}" onsubmit="return confirm('{{ __('Are you sure you want to delete this reservation?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-800 hover:bg-gray-200">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{__('Event Start: ')}} {{ $reservation->event->start }}</span>
                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{__('Event End: ')}} {{ $reservation->event->end }}</span>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
