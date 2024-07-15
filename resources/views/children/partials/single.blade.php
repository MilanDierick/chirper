<a href="{{ route('children.edit', $child) }}" class="block bg-white shadow overflow-hidden sm:rounded-lg p-6 hover:bg-gray-50 transition duration-300">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $child->first_name }} {{ $child->last_name }}</h2>
    </div>
    <div class="space-y-2">
        <div class="flex flex-wrap items-center space-x-2">
            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ __('Date of Birth:') }} {{ $child->date_of_birth->format('j M Y') }}</span>
            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ __('Class Level:') }} {{ $child->classLevel->level }}</span>
            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ $child->school->name }}</span>
            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ $child->schoolType->type }}</span>
            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ __('Special Needs:') }} {{ $child->special_needs ? 'Yes' : 'No' }}</span>
            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-md">{{ __('Media Consent:') }} {{ $child->media_consent ? 'Yes' : 'No' }}</span>
        </div>
        <div class="mt-4">
            <p class="text-gray-600">{{ $child->information }}</p>
        </div>
    </div>
</a>
