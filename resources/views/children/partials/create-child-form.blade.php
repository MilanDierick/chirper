<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Child Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Enter your child's profile information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('children.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="first_name" :value="__('First Name')"/>
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name')" required autofocus autocomplete="first_name"/>
            <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')"/>
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name')" required autocomplete="last_name"/>
            <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
        </div>

        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')"/>
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth')" required/>
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')"/>
        </div>

        <div>
            <x-input-label for="class_level_id" :value="__('Class Level')"/>
            <select id="class_level_id" name="class_level_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach(App\Models\ClassLevel::all() as $level)
                    <option value="{{ $level->id }}" {{ $level->id == old('class_level_id') ? 'selected' : '' }}>{{ $level->level }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('class_level_id')"/>
        </div>

        <div>
            <x-input-label for="school_id" :value="__('School')"/>
            <select id="school_id" name="school_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach(App\Models\School::all() as $school)
                    <option value="{{ $school->id }}" {{ $school->id == old('school_id') ? 'selected' : '' }}>{{ $school->name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('school_id')"/>
        </div>

        <div>
            <x-input-label for="school_type_id" :value="__('School Type')"/>
            <select id="school_type_id" name="school_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach(App\Models\SchoolType::all() as $type)
                    <option value="{{ $type->id }}" {{ $type->id == old('school_type_id') ? 'selected' : '' }}>{{ $type->type }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('school_type_id')"/>
        </div>

        <div>
            <x-input-label for="information" :value="__('Information')"/>
            <textarea id="information" name="information" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('information') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('information')"/>
        </div>

        <div>
            <x-input-label for="special_needs" :value="__('Special Needs')"/>
            <select id="special_needs" name="special_needs" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="1" {{ old('special_needs') == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                <option value="0" {{ old('special_needs') == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('special_needs')"/>
        </div>

        <div>
            <x-input-label for="media_consent" :value="__('Media Consent')"/>
            <select id="media_consent" name="media_consent" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="1" {{ old('media_consent') == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                <option value="0" {{ old('media_consent') == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('media_consent')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
