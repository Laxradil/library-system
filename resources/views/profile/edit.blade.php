<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight animate-fade-in-up flex items-center gap-3">
            <span class="text-2xl">⚙️</span>
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl animate-fade-in-up transition-all duration-300 hover:shadow-2xl" style="animation-delay: 100ms;">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl animate-fade-in-up transition-all duration-300 hover:shadow-2xl" style="animation-delay: 200ms;">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl animate-fade-in-up transition-all duration-300 hover:shadow-2xl border-2 border-red-100 dark:border-red-900/30" style="animation-delay: 300ms;">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
