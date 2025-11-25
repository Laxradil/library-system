<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Password strength meter -->
            <div class="mt-2" role="status" aria-live="polite">
                <div id="password-meter" class="w-full h-2 bg-gray-200 rounded overflow-hidden">
                    <div id="password-meter-bar" class="h-2 w-0 bg-red-500 transition-all"></div>
                </div>
                <p id="password-meter-msg" class="mt-1 text-sm text-gray-600"></p>
                <ul class="mt-2 text-sm text-gray-600 space-y-1">
                    <li id="pw-check-length">• Between 8 and 64 characters</li>
                    <li id="pw-check-number">• Contains a number</li>
                    <li id="pw-check-symbol">• Contains a symbol (e.g. !@#$%)</li>
                </ul>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- Submission reason shown while submit is disabled -->
        <p id="password-submit-reason" class="mt-2 text-sm text-red-600" aria-live="polite"></p>
        </div>
    </form>
</x-guest-layout>
