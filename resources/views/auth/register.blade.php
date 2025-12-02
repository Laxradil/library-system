<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8 animate-fade-in-up">
        <h2 class="text-3xl font-bold text-white mb-2">Create Account</h2>
        <p class="text-gray-400">Join our library community today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="animate-fade-in-up stagger-item" style="animation-delay: 0.1s; animation-fill-mode: forwards;">
            <label for="name" class="auth-label">{{ __('Full Name') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" 
                    class="auth-input pl-12" 
                    placeholder=""
                    required autofocus autocomplete="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>
        
        <!-- Email Address -->
        <div class="animate-fade-in-up stagger-item" style="animation-delay: 0.15s; animation-fill-mode: forwards;">
            <label for="email" class="auth-label">{{ __('Email Address') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                    class="auth-input pl-12" 
                    placeholder=""
                    required autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="animate-fade-in-up stagger-item" style="animation-delay: 0.2s; animation-fill-mode: forwards;">
            <label for="password" class="auth-label">{{ __('Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" 
                    class="auth-input pl-12 pr-12" 
                    placeholder=""
                    required autocomplete="new-password" />
                <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-200 transition-colors duration-200">
                    <svg id="password-eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="password-eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />

            <!-- Password strength UI -->
            <div class="mt-4 p-4 rounded-xl bg-white/5 border border-white/10">
                <div class="h-2 w-full bg-gray-700 rounded-full overflow-hidden">
                    <div id="password-strength-bar" class="h-2 w-0 rounded-full transition-all duration-500 bg-gradient-to-r from-red-500 via-yellow-400 to-green-500"></div>
                </div>
                <div class="mt-3 flex items-center gap-3 text-sm">
                    <div id="pw-strength-text" class="font-semibold text-gray-400">Very weak</div>
                </div>

                <ul id="password-criteria" class="mt-4 grid grid-cols-2 gap-3 text-sm">
<li class="flex items-center gap-2 text-gray-500 transition-all duration-300" data-criterion="length">
                        <svg class="w-4 h-4 text-gray-600 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span>8-62 characters</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-500 transition-all duration-300" data-criterion="uppercase">
                        <svg class="w-4 h-4 text-gray-600 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span>1 uppercase letter</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-500 transition-all duration-300" data-criterion="number">
                        <svg class="w-4 h-4 text-gray-600 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span>1 number</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-500 transition-all duration-300" data-criterion="symbol">
                        <svg class="w-4 h-4 text-gray-600 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span>1 symbol (!@#$%)</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="animate-fade-in-up stagger-item" style="animation-delay: 0.25s; animation-fill-mode: forwards;">
            <label for="password_confirmation" class="auth-label">{{ __('Confirm Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" 
                    class="auth-input pl-12 pr-12" 
                    placeholder=""
                    required autocomplete="new-password" />
                <button type="button" id="toggle-password-confirm" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-200 transition-colors duration-200">
                    <svg id="password-confirm-eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="password-confirm-eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <!-- Submit Button -->
        <div class="animate-fade-in-up stagger-item pt-2" style="animation-delay: 0.3s; animation-fill-mode: forwards;">
            <button type="submit" class="auth-btn group">
                <span class="flex items-center justify-center gap-2">
                    {{ __('Create Account') }}
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </span>
            </button>
        </div>

        <!-- Divider -->
        <div class="relative my-4 animate-fade-in stagger-item" style="animation-delay: 0.35s; animation-fill-mode: forwards;">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-600"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 text-gray-400 bg-transparent">Already have an account?</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center animate-fade-in-up stagger-item" style="animation-delay: 0.4s; animation-fill-mode: forwards;">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-gray-300 hover:text-white transition-all duration-300 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                <span>Sign in instead</span>
            </a>
        </div>
    </form>

    <script>
        (function(){
            const pwd = document.getElementById('password');
            const bar = document.getElementById('password-strength-bar');
            const text = document.getElementById('pw-strength-text');
            const criteria = document.querySelectorAll('#password-criteria [data-criterion]');

            if (!pwd) return;

            function testPassword(value) {
                return {
                    length: value.length >= 8 && value.length <= 62,
                    uppercase: /[A-Z]/.test(value),
                    number: /[0-9]/.test(value),
                    symbol: /[^A-Za-z0-9]/.test(value),
                };
            }

            function updateUI(value){
                const res = testPassword(value);
                const passed = Object.values(res).filter(Boolean).length;
                const pct = (passed / 4) * 100;

                if (bar) bar.style.width = pct + '%';

                // Update strength text and colors
                if (pct <= 25) {
                    text.textContent = 'Very weak';
                    text.className = 'font-semibold text-red-400';
                } else if (pct <= 50) {
                    text.textContent = 'Weak';
                    text.className = 'font-semibold text-orange-400';
                } else if (pct <= 75) {
                    text.textContent = 'Good';
                    text.className = 'font-semibold text-yellow-400';
                } else {
                    text.textContent = 'Strong';
                    text.className = 'font-semibold text-green-400';
                }

                // Update checklist with animations
                criteria.forEach(li => {
                    const key = li.getAttribute('data-criterion');
                    const ok = !!res[key];
                    const svg = li.querySelector('svg');
                    if (ok) {
                        li.classList.remove('text-gray-500');
                        li.classList.add('text-green-400');
                        if (svg) {
                            svg.classList.remove('text-gray-600');
                            svg.classList.add('text-green-400');
                            svg.style.transform = 'scale(1.2)';
                            setTimeout(() => svg.style.transform = 'scale(1)', 200);
                        }
                    } else {
                        li.classList.remove('text-green-400');
                        li.classList.add('text-gray-500');
                        if (svg) {
                            svg.classList.remove('text-green-400');
                            svg.classList.add('text-gray-600');
                        }
                    }
                });
            }

            pwd.addEventListener('input', e => updateUI(e.target.value));
            updateUI(pwd.value || '');
        })();

        // Password visibility toggle
        (function(){
            // Toggle for main password field
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('password-eye-open');
            const eyeClosed = document.getElementById('password-eye-closed');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    eyeOpen.classList.toggle('hidden');
                    eyeClosed.classList.toggle('hidden');
                });
            }

            // Toggle for confirm password field
            const togglePasswordConfirm = document.getElementById('toggle-password-confirm');
            const passwordConfirmInput = document.getElementById('password_confirmation');
            const eyeOpenConfirm = document.getElementById('password-confirm-eye-open');
            const eyeClosedConfirm = document.getElementById('password-confirm-eye-closed');

            if (togglePasswordConfirm && passwordConfirmInput) {
                togglePasswordConfirm.addEventListener('click', function() {
                    const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordConfirmInput.setAttribute('type', type);
                    eyeOpenConfirm.classList.toggle('hidden');
                    eyeClosedConfirm.classList.toggle('hidden');
                });
            }
        })();
    </script>
</x-guest-layout>
