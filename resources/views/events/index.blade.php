<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div id="events-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($events as $event)
                @include('events.partials.event-card', ['event' => $event])
            @endforeach
        </div>
        <div id="loading" class="text-center py-10" style="display: none;">
            <span>Loading...</span>
        </div>
    </div>
</x-app-layout>

<script>
    let page = 1;
    let hasMoreEvents = true;
    let loading = false; // Flag to indicate if a request is in progress

    window.onscroll = function() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
            loadMoreEvents();
        }
    };

    function loadMoreEvents() {
        if (!hasMoreEvents || loading) {
            return;
        }

        loading = true; // Set the flag to indicate loading is in progress
        page++;
        document.getElementById('loading').style.display = 'block';

        fetch(`{{ url('/events?page=') }}${page}`, {
            headers: {
                'Accept': 'application/json',
            }
        })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading').style.display = 'none';
                loading = false; // Reset the flag after loading is complete

                if (data.next_page_url === null) {
                    hasMoreEvents = false;
                    return;
                }

                const eventsContainer = document.getElementById('events-container');
                eventsContainer.insertAdjacentHTML('beforeend', data.html);
            }).catch(error => {
            console.error('Error fetching more events:', error);
            document.getElementById('loading').style.display = 'none';
            loading = false; // Reset the flag even if there is an error
        });
    }
</script>
