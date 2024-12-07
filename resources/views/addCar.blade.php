<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Car') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('addCar') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="car_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Car Name</label>
                            <input type="text" name="car_name" id="car_name" 
                                   class="block w-full mt-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500" 
                                   required>
                        </div>
                        <div class="mb-4">
                            <label for="distance_travelled" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Distance Travelled</label>
                            <input type="number" name="distance_travelled" id="distance_travelled" 
                                   class="block w-full mt-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500" 
                                   required>
                        </div>
                        <div class="mb-4">
                            <label for="date_of_purchase" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Purchase</label>
                            <input type="date" name="date_of_purchase" id="date_of_purchase" 
                                   class="block w-full mt-1 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500" 
                                   required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Car
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
