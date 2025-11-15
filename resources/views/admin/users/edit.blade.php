<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User:') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">User Information</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Update the user's profile information and role.
                    </p>

                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT') <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                            <input id="name" name="name" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('name', $user->name) }}" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input id="email" name="email" type="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>
                            <select id="role" name="role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                <option value="contributor" @if($user->role == 'contributor') selected @endif>Contributor</option>
                                <option value="viewer" @if($user->role == 'viewer') selected @endif>Viewer</option>
                            </select>
                        </div>

                        <div class="border-t border-gray-200 mt-6 pt-6"></div>

                        <h3 class="text-lg font-medium text-gray-900">Reset Password</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Set a new password for this user. Leave blank to keep the current password.
                        </p>

                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">New Password</label>
                            <input id="password" name="password" type="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                        </div>

                        <div class="mt-4">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirm New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">Delete User</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Once this user is deleted, all of their resources and data will be permanently removed.
                    </p>

                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mt-6">
                        @csrf
                        @method('DELETE') <button type_="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500"
                                onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            Delete User
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>