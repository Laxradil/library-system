<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />

    <script>
        (function(){
            const pwd = document.getElementById('password');
            const bar = document.getElementById('password-strength-bar');
            const text = document.getElementById('pw-strength-text');
            const criteria = document.querySelectorAll('#password-criteria [data-criterion]');

            if (!pwd) return;

            function testPassword(value) {
                const results = {
                    length: value.length >= 8 && value.length <= 64,
                    uppercase: /[A-Z]/.test(value),
                    number: /[0-9]/.test(value),
                    symbol: /[^A-Za-z0-9]/.test(value),
                };
                return results;
            }

            function updateUI(value){
                const res = testPassword(value);
                const passed = Object.values(res).filter(Boolean).length;
                const pct = (passed / 4) * 100;

                bar.style.width = pct + '%';

                // color mapping
                if (pct <= 25) {
                    bar.classList.remove('from-yellow-400','to-green-500');
                    bar.classList.add('from-red-500');
                    text.textContent = 'Very weak';
                } else if (pct <= 50) {
                    bar.classList.remove('from-red-500','to-green-500');
                    bar.classList.add('from-yellow-400');
                    text.textContent = 'Weak';
                } else if (pct <= 75) {
                    bar.classList.remove('from-red-500','from-yellow-400');
                    bar.classList.add('from-yellow-400','to-green-500');
                    text.textContent = 'Good';
                } else {
                    bar.classList.remove('from-red-500','from-yellow-400');
                    bar.classList.add('from-green-500');
                    text.textContent = 'Strong';
                }

                // update checklist icons and color
                criteria.forEach(li => {
                    const key = li.getAttribute('data-criterion');
                    const ok = !!res[key];
                    const svg = li.querySelector('svg');
                    if (ok) {
                        li.classList.remove('text-gray-500');
                        li.classList.add('text-green-600');
                        if (svg) svg.classList.remove('text-gray-300');
                        if (svg) svg.classList.add('text-green-600');
                    } else {
                        li.classList.remove('text-green-600');
                        li.classList.add('text-gray-500');
                        if (svg) svg.classList.remove('text-green-600');
                        if (svg) svg.classList.add('text-gray-300');
                    }
                });
            }

            pwd.addEventListener('input', e => updateUI(e.target.value));
            // initialize if value present
            updateUI(pwd.value || '');
        })();
    </script>

</x-guest-layout>
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

            <!-- Password strength UI -->
            <div class="mt-3">
                <div class="h-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div id="password-strength-bar" class="h-2 w-0 rounded-full transition-all duration-300 bg-gradient-to-r from-red-500 via-yellow-400 to-green-500"></div>
                </div>
                <div class="mt-2 flex items-center gap-3 text-xs text-gray-600 dark:text-gray-300">
                    <div id="pw-strength-text" class="font-medium">Very weak</div>
                    <div class="flex-1 h-px bg-transparent"></div>
                </div>

                <ul id="password-criteria" class="mt-3 grid grid-cols-2 gap-2 text-sm">
                    <li class="flex items-center gap-2 text-gray-500" data-criterion="length">
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        8–64 characters
                    </li>
                    <li class="flex items-center gap-2 text-gray-500" data-criterion="uppercase">
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        1 uppercase letter
                    </li>
                    <li class="flex items-center gap-2 text-gray-500" data-criterion="number">
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        1 number
                    </li>
                    <li class="flex items-center gap-2 text-gray-500" data-criterion="symbol">
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        1 symbol (e.g. !@#$%)
                    </li>
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
    </form>
</x-guest-layout>
