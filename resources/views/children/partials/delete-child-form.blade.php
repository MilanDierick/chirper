<!-- resources/views/children/partials/delete-child-form.blade.php -->

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Child') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your child\'s profile is deleted, all of its resources and data will be permanently deleted. Before deleting the profile, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-child-deletion')"
    >{{ __('Delete Child') }}</x-danger-button>

    <x-modal name="confirm-child-deletion" :show="$errors->childDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('children.destroy', $child) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this child\'s profile?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once the profile is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete this child\'s profile.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only"/>

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->childDeletion->get('password')" class="mt-2"/>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Child') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
