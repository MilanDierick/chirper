<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Chirp Details
                </h2>
                <p class="text-gray-700 mt-4">
                    <strong>Message:</strong> {{ $chirp->message }}
                </p>
                <p class="text-gray-700 mt-2">
                    <strong>Author:</strong> {{ $chirp->user->name }}
                </p>
                <p class="text-gray-700 mt-2">
                    <strong>Posted At:</strong> {{ $chirp->created_at->toFormattedDateString() }}
                </p>
                <div class="mt-4">
                    <a href="{{ route('chirps.index') }}" class="text-indigo-600 hover:text-indigo-900">Back to all chirps</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
