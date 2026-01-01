<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Please complete your profile information to proceed.') }}
    </div>

    <form method="POST" action="{{ route('applicant.profile.store') }}">
        @csrf

        <!-- Email (Readonly) -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-100" type="email" name="email"
                :value="$user->email" readonly />
        </div>

        <!-- Phone / Whatsapp -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Whatsapp Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                required autofocus />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- ID Card (KTP) -->
        <div class="mt-4">
            <x-input-label for="id_card" :value="__('No. KTP')" />
            <x-text-input id="id_card" class="block mt-1 w-full" type="text" name="id_card" :value="old('id_card')"
                required />
            <x-input-error :messages="$errors->get('id_card')" class="mt-2" />
        </div>

        <!-- Birth Place -->
        <div class="mt-4">
            <x-input-label for="birth_place" :value="__('Birth Place')" />
            <x-text-input id="birth_place" class="block mt-1 w-full" type="text" name="birth_place" :value="old('birth_place')"
                required />
            <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
        </div>

        <!-- Birth Day -->
        <div class="mt-4">
            <x-input-label for="birth_day" :value="__('Birth Day')" />
            <x-text-input id="birth_day" class="block mt-1 w-full" type="date" name="birth_day" :value="old('birth_day')"
                required />
            <x-input-error :messages="$errors->get('birth_day')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="sex" :value="__('Gender')" />
            <select id="sex" name="sex"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <x-input-error :messages="$errors->get('sex')" class="mt-2" />
        </div>

        <!-- Blood Type -->
        <div class="mt-4">
            <x-input-label for="blood_type" :value="__('Blood Type')" />
            <select id="blood_type" name="blood_type"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="-">-</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
            <x-input-error :messages="$errors->get('blood_type')" class="mt-2" />
        </div>

        <!-- Marital Status -->
        <div class="mt-4">
            <x-input-label for="marital_status" :value="__('Marital Status')" />
            <select id="marital_status" name="marital_status"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Menikah">Menikah</option>
                <option value="Janda/Duda">Janda/Duda</option>
            </select>
            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
        </div>

        <!-- Religion -->
        <div class="mt-4">
            <x-input-label for="religion" :value="__('Religion')" />
            <select id="religion" name="religion"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
            <x-input-error :messages="$errors->get('religion')" class="mt-2" />
        </div>

        <!-- Suku (Ethnicity) -->
        <div class="mt-4">
            <x-input-label for="suku" :value="__('Suku / Ethnicity')" />
            <x-text-input id="suku" class="block mt-1 w-full" type="text" name="suku" :value="old('suku')"
                required />
            <x-input-error :messages="$errors->get('suku')" class="mt-2" />
        </div>

        <!-- Career / Position Interest -->
        <div class="mt-4">
            <x-input-label for="career_id" :value="__('Minat Bagian')" />
            <select id="career_id" name="career_id"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach ($careers as $career)
                    <option value="{{ $career->id }}">{{ $career->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('career_id')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" name="address"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm h-24"
                required>{{ old('address') }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Submit Profile') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
