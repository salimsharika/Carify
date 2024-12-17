<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Edit User: {{ $user->name }}</h3>

                    <form action="{{ route('admin.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full">
                        </div>

                        <div class="mb-4">
                            <label for="usertype" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="usertype" name="usertype" class="mt-1 block w-full" required>
                                <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('usertype', $user->usertype) == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
