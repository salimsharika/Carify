<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marketplace') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Cars for Sale</h3>
                    @if($cars->isEmpty())
                        <p class="text-gray-500">No cars are currently listed for sale.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Car Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Distance Travelled</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Owner</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($cars as $car)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $car->car_name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $car->distance_travelled }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $car->owner->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                            @if($car->user_id === auth()->id())
                                                <form action="{{ route('toggleSale', $car->id) }}" method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to remove this car from the marketplace?');">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                        Remove from Sale
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-500 italic">Contact Owner</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <!-- Comments Section -->
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Comments</h4>
                        @foreach($cars as $car)
                            <div class="mb-4">
                                <h5 class="font-bold">Comments for {{ $car->car_name }}</h5>
                                @foreach($car->comments as $comment)
                                    <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded mb-2">
                                        <p class="text-sm">{{ $comment->comment }}</p>
                                        <p class="text-xs text-gray-500">- {{ $comment->user->name }}</p>
                                    </div>
                                @endforeach
                                <form action="{{ route('storeComment', $car->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <textarea name="comment" class="w-full p-2 border rounded" rows="3" placeholder="Add a comment..."></textarea>
                                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>