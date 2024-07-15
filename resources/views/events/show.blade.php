<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left column for event details -->
            <div class="bg-white shadow-xl sm:rounded-lg w-full lg:w-2/3">
                <div class="relative" style="padding-top: 56.25%; overflow: hidden; position: relative; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                    <img src="{{ $event->image_url ?? 'https://placehold.co/800x800' }}" alt="{{ $event->title }}" class="absolute top-0 left-0 w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h1 class="text-2xl font-semibold text-gray-900 mb-2">{{ $event->title }}</h1>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-200 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded"><i class="far fa-calendar-alt mr-1"></i>{{ $event->start->format('d.m.Y') }} - {{ $event->end->format('d.m.Y') }}</span>
                        <span class="bg-gray-200 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded">{{ $event->getClassRangeAttribute() }}</span>
                    </div>

                    <p class="text-gray-700 mb-4">{{ $event->description }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <strong>Start:</strong> {{ $event->start->format('d.m.Y H:i') }}<br>
                            <strong>End:</strong> {{ $event->end->format('d.m.Y H:i') }}
                        </div>
                        <div>
                            <strong>Duration:</strong> {{ $event->duration }} days
                        </div>
                    </div>

                    @auth
                        @can('update', $event)
                            <div class="flex justify-between items-center">
                                <a href="/nova/resources/events/{{ $event->id }}/edit" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600">
                                    Edit
                                </a>
                                @endcan

                                @can('export', $event)
                                    <form method="POST" action="{{ route('events.export', $event) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white text-sm font-medium rounded-md hover:bg-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17 10.5a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z"/>
                                                <path d="M13 9V5a3 3 0 00-6 0v1H6a3 3 0 000 6h1v2H6a3 3 0 000 6h2v-2H6a1 1 0 010-2h2v-4H7a1 1 0 010-2h2v2H8a1 1 0 010-2h3V5a1 1 0 112 0v1h1a1 1 0 010 2h-1v2h1a1 1 0 010 2h-1v-2h-2V9h1z"/>
                                            </svg>
                                            Export CSV
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        @endauth
                </div>
            </div>

            <!-- Right column for organizer details and map -->
            <div class="bg-white shadow-xl sm:rounded-lg p-6 w-full lg:w-1/3 relative">
                <x-reservation-button :event="$event" />

                <h2 class="text-xl font-semibold text-gray-900 mb-4">Kontakt</h2>
                <p class="text-gray-700">
                    <strong>{{ $event->author->full_name }}</strong><br>
                    <a href="mailto:{{ $event->author->email }}" class="text-indigo-500">{{ $event->author->email }}</a><br>
                    <a href="tel:{{ $event->author->phone }}" class="text-indigo-500">{{ $event->author->phone }}</a>
                </p>

                <h2 class="text-xl font-semibold text-gray-900 mt-6 mb-4">Veranstaltungsort</h2>
                <p class="text-gray-700 mb-4">
                    {{ $event->address }}<br>
                </p>
                <iframe src="https://www.google.com/maps?q={{ urlencode($event->address) }}&output=embed" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>

    <!-- Modal for creating reservation -->
    <div id="reservation-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form method="POST" action="{{ route('reservations.store') }}">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ __('Create Reservation') }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        {{ __('Select a child to create a reservation for this event.') }}
                                    </p>
                                    <div class="mt-4">
                                        <label for="child_id" class="block text-sm font-medium text-gray-700">{{ __('Child') }}</label>
                                        <select id="child_id" name="child_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                                required>
                                            @foreach (auth()->user()->children as $child)
                                                <option value="{{ $child->id }}">{{ $child->first_name }} {{ $child->last_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <input type="hidden" name="request_type" value="request">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Create Reservation') }}
                        </button>
                        <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                onclick="document.getElementById('reservation-modal').classList.add('hidden');">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
