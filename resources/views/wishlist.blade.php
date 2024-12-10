<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wishlist') }}
        </h2>
    </x-slot>

    <div class="container text-black">
        <h1>Your Wishlist</h1>
        <div class="row">
            @forelse($wishlistCars as $car)
                <div class="col-md-4">
                    <div class="card mb-4 border border-gray-300 shadow-lg">
                        <div class="card-body bg-gray-50">
                            <h5 class="card-title text-blue-600">{{ $car->car_name }}</h5>
                            <p class="card-text text-gray-700">Distance Travelled: {{ $car->distance_travelled }} km</p>
                            <p class="card-text text-gray-700">Date of Purchase: {{ $car->date_of_purchase->format('d-m-Y') }}</p>
                            <p class="card-text text-gray-700">Owner: {{ $car->owner->name }}</p>
                            <form action="{{ route('wishlist.remove', $car->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove from Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>No cars in your wishlist.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
