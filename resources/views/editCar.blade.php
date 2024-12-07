<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Car') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('updateCar', $car->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="car_name" class="block text-sm font-medium">Car Name</label>
                            <input type="text" name="car_name" id="car_name" value="{{ $car->car_name }}" required class="block w-full mt-1 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="distance_travelled" class="block text-sm font-medium">Distance Travelled</label>
                            <input type="number" name="distance_travelled" id="distance_travelled" value="{{ $car->distance_travelled }}" required class="block w-full mt-1 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="date_of_purchase" class="block text-sm font-medium">Date of Purchase</label>
                            <input type="date" name="date_of_purchase" id="date_of_purchase" value="{{ $car->date_of_purchase }}" required class="block w-full mt-1 rounded-md">
                        </div>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Update Car
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
