<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Notifications') }}
            </h2>
            @if($notifications->where('is_read', false)->count() > 0)
                <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                        Mark All as Read
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($notifications->isEmpty())
                        <p class="text-gray-500 text-center py-4">No notifications.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach($notifications as $notification)
                                <li class="p-4 {{ $notification->is_read ? 'bg-gray-50' : 'bg-blue-50' }} dark:bg-gray-700 rounded-lg">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-grow">
                                            <p class="mb-1">
                                                <span class="font-semibold">{{ $notification->comment->user->name }}</span> 
                                                commented on your car post:
                                            </p>
                                            <p class="text-gray-600 dark:text-gray-300">"{{ $notification->comment->comment }}"</p>
                                            <p class="text-sm text-gray-500 mt-2">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        @if(!$notification->is_read)
                                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="ml-4">
                                                @csrf
                                                <button type="submit" class="text-blue-500 hover:text-blue-600 text-sm">
                                                    Mark as Read
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
