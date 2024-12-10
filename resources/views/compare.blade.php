<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compare Cars') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Comparison Results</h3>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Attribute</th>
                                @foreach($cars as $car)
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $car->car_name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-500 dark:text-gray-400">Distance Travelled</td>
                                @foreach($cars as $car)
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $car->distance_travelled }} km</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-500 dark:text-gray-400">Date of Purchase</td>
                                @foreach($cars as $car)
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $car->date_of_purchase->format('d-m-Y') }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-500 dark:text-gray-400">Owner</td>
                                @foreach($cars as $car)
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $car->owner->name }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
