<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Car Details and Suggestions for {{ $car->car_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Current Car Details -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Current Car Details</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="font-medium">Car Name:</p>
                            <p>{{ $car->car_name }}</p>
                        </div>
                        <div>
                            <p class="font-medium">Distance Travelled:</p>
                            <p>{{ number_format($car->distance_travelled) }} km</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maintenance Suggestions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Maintenance Suggestions</h3>
                    
                    @if(count($maintenanceSuggestions) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($maintenanceSuggestions as $suggestion)
                                <div class="border dark:border-gray-700 rounded-lg p-4">
                                    <h4 class="font-medium text-lg mb-3 text-blue-600 dark:text-blue-400">
                                        {{ $suggestion['type'] }}
                                    </h4>
                                    <ul class="list-disc ml-5 space-y-2">
                                        @foreach($suggestion['items'] as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No maintenance suggestions at this time.</p>
                    @endif
                </div>
            </div>

            <!-- Similar Cars -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Similar Cars</h3>
                    
                    @if($suggestions->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($suggestions as $suggestion)
                                <div class="border dark:border-gray-700 rounded-lg p-4">
                                    <h4 class="font-medium mb-2">{{ $suggestion->car_name }}</h4>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        <p>Distance: {{ number_format($suggestion->distance_travelled) }} km</p>
                                        @if($suggestion->is_for_sale)
                                            <p class="mt-2 text-green-600 dark:text-green-400">Available for Sale</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No similar cars found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
