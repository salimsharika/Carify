<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Welcome to the Admin Dashboard</h3>
                    <p>You can manage the application here.</p>

                    <!-- Table to display users -->
                    <div class="mt-6">
                        <h4 class="text-xl">User Management</h4>
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border-b">Name</th>
                                    <th class="px-4 py-2 border-b">Email</th>
                                    <th class="px-4 py-2 border-b">Phone</th>
                                    <th class="px-4 py-2 border-b">Role</th>
                                    <th class="px-4 py-2 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                                        <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                                        <td class="px-4 py-2 border-b">{{ $user->phone }}</td>
                                        <td class="px-4 py-2 border-b">
                                            @if ($user->usertype === 'admin')
                                                Admin
                                            @else
                                                User
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border-b">
                                            <form action="{{ route('admin.delete', $user->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
