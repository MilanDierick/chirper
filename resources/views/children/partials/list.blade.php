<div class="space-y-6" id="children-list">
    @if ($children->isEmpty())
        <p class="text-center text-gray-500">No children available.</p>
    @else
        @foreach ($children as $child)
            <div class="relative block bg-white shadow overflow-hidden sm:rounded-lg p-6 hover:bg-gray-50 transition duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $child->first_name }} {{ $child->last_name }}</h2>
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                        <div>
                            <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                Options
                                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                <a href="{{ route('children.edit', $child->id) }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Edit</a>
                                <form method="POST" action="{{ route('children.destroy', $child->id) }}" role="none">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Delete</button>
                                </form>
                                <a href="{{ route('children.reservations', $child->id) }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">Reservations</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center space-x-2">
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ __('Date of Birth:') }} {{ $child->date_of_birth->format('j M Y') }}</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ __('Class Level:') }} {{ $child->classLevel->level }}</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ $child->school->name }}</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ __('Special Needs:') }} {{ $child->special_needs ? 'Yes' : 'No' }}</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ __('Media Consent:') }} {{ $child->media_consent ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-600">{{ $child->information }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
