<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Suggestions for {{ $car->car_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Similar Cars -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Similar Cars</h3>
                    @if($similarCars->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($similarCars as $similarCar)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $similarCar->car_name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        Distance: {{ number_format($similarCar->distance_travelled) }} km
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('marketplace') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                            View in Marketplace
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No similar cars found.</p>
                    @endif
                </div>
            </div>

            <!-- Price Range Cars -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Cars in Similar Price Range</h3>
                    @if($priceRangeCars->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($priceRangeCars as $priceCar)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $priceCar->car_name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        Distance: {{ number_format($priceCar->distance_travelled) }} km
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('marketplace') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                            View in Marketplace
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No cars found in similar price range.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
