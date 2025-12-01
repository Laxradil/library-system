<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight animate-fade-in-up flex items-center gap-3">
            <span class="text-2xl">✏️</span>
            {{ __('Edit User:') }} <span class="text-indigo-600 dark:text-indigo-400">{{ $user->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- User Information Card -->
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl animate-fade-in-up transition-all duration-300 hover:shadow-2xl" style="animation-delay: 100ms;">
                <div class="max-w-xl">
                    <header class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">User Information</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Update the user's profile information and role.</p>
                        </div>
                    </header>

                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="animate-fade-in-up" style="animation-delay: 150ms;">
                            <label for="name" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">👤 Name</label>
                            <input id="name" name="name" type="text" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500" 
                                value="{{ old('name', $user->name) }}" required autofocus placeholder="User's full name">
                        </div>

                        <div class="animate-fade-in-up" style="animation-delay: 200ms;">
                            <label for="email" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">📧 Email</label>
                            <input id="email" name="email" type="email" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500" 
                                value="{{ old('email', $user->email) }}" required placeholder="user@email.com">
                        </div>

                        <div class="animate-fade-in-up" style="animation-delay: 250ms;">
                            <label for="role" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">🎭 Role</label>
                            <select id="role" name="role" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 hover:border-gray-300 dark:hover:border-gray-500 cursor-pointer">
                                <option value="admin" @if($user->role == 'admin') selected @endif>🛡️ Admin</option>
                                <option value="contributor" @if($user->role == 'contributor') selected @endif>✏️ Contributor</option>
                                <option value="viewer" @if($user->role == 'viewer') selected @endif>👁️ Viewer</option>
                            </select>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6"></div>

                        <header class="flex items-center gap-3 mb-4 animate-fade-in-up" style="animation-delay: 300ms;">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center text-white shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Reset Password</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Leave blank to keep the current password.</p>
                            </div>
                        </header>

                        <div class="animate-fade-in-up" style="animation-delay: 350ms;">
                            <label for="password" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">🔐 New Password</label>
                            <input id="password" name="password" type="password" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500"
                                placeholder="Enter new password">
                        </div>

                        <div class="animate-fade-in-up" style="animation-delay: 400ms;">
                            <label for="password_confirmation" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">✅ Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all duration-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 focus:-translate-y-0.5 focus:shadow-lg hover:border-gray-300 dark:hover:border-gray-500"
                                placeholder="Confirm new password">
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700 animate-fade-in-up" style="animation-delay: 450ms;">
                            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors duration-300 hover:underline flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Back to Users
                            </a>
                            <button type="submit" 
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete User Card -->
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl animate-fade-in-up transition-all duration-300 hover:shadow-2xl border-2 border-red-100 dark:border-red-900/30" style="animation-delay: 500ms;">
                <div class="max-w-xl">
                    <header class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-rose-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Danger Zone</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Permanently delete this user account.</p>
                        </div>
                    </header>

                    <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800/50 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            <p class="text-sm text-red-800 dark:text-red-200">
                                Once this user is deleted, all of their resources and data will be permanently removed. This action cannot be undone.
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 active:scale-95"
                            onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete User
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>