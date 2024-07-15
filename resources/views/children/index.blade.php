<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:px-8">
        <!-- New Section Heading -->
        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-3xl font-semibold leading-6 text-gray-900">{{ __('Children') }}</h3>
            <div class="mt-3 sm:ml-4 sm:mt-0 flex items-center">
                <a href="{{ route('children.create') }}" class="bg-blue-500 text-white px-4 py-2.5 rounded-md hover:bg-blue-600 transition duration-300 mr-2">{{ __('Add New Child') }}</a>
                <form id="search-form" method="GET" action="{{ route('children.index') }}" onsubmit="handleSearchSubmit(event)" class="flex">
                    <label for="mobile-search-candidate" class="sr-only">Search</label>
                    <label for="desktop-search-candidate" class="sr-only">Search</label>
                    <div class="flex rounded-md shadow-sm">
                        <div class="relative flex-grow focus-within:z-10">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="mobile-search-candidate" class="block w-full rounded-none rounded-l-md border-0 py-2.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:hidden" placeholder="Search" value="{{ request('search') }}">
                            <input type="text" name="search" id="desktop-search-candidate" class="hidden w-full rounded-none rounded-l-md border-0 py-2.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:block" placeholder="Search children" value="{{ request('search') }}">
                        </div>
                        <button type="button" id="sort-button" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2.5 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg class="-ml-0.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M2 3.75A.75.75 0 012.75 3h11.5a.75.75 0 010 1.5H2.75A.75.75 0 012 3.75zM2 7.5a.75.75 0 01.75-.75h6.365a.75.75 0 010 1.5H2.75A.75.75 0 012 7.5zM14 7a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02l-1.95-2.1v6.59a.75.75 0 01-1.5 0V9.66l-1.95 2.1a.75.75 0 11-1.1-1.02l3.25-3.5A.75.75 0 0114 7zM2 11.25a.75.75 0 01.75-.75H7A.75.75 0 017 12H2.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                            </svg>
                            Sort
                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5A.75.75 0 015.23 7.21z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="space-y-6" id="children-list">
            @foreach ($children as $child)
                @include('children.partials.single', ['child' => $child])
            @endforeach
        </div>
    </div>
</x-app-layout>

<script>
    function debounce(func, delay) {
        let debounceTimer;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        };
    }

    function handleSearchSubmit(event) {
        event.preventDefault();
        const searchInputMobile = document.getElementById('mobile-search-candidate');
        const searchInputDesktop = document.getElementById('desktop-search-candidate');
        const searchQuery = searchInputMobile.value || searchInputDesktop.value;
        const searchForm = document.getElementById('search-form');
        const childrenList = document.getElementById('children-list');

        fetch(`${searchForm.action}?search=${searchQuery}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newChildrenList = doc.getElementById('children-list').innerHTML;
                childrenList.innerHTML = newChildrenList;
                if (searchInputMobile.value) {
                    searchInputMobile.focus();
                } else {
                    searchInputDesktop.focus();
                }
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInputMobile = document.getElementById('mobile-search-candidate');
        const searchInputDesktop = document.getElementById('desktop-search-candidate');
        const searchForm = document.getElementById('search-form');

        const handleSearch = debounce(function() {
            handleSearchSubmit(new Event('input'));
        }, 500);

        if (searchInputMobile) {
            searchInputMobile.addEventListener('input', handleSearch);
        }

        if (searchInputDesktop) {
            searchInputDesktop.addEventListener('input', handleSearch);
        }

        searchForm.addEventListener('submit', handleSearchSubmit);
    });
</script>
