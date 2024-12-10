{{ ... }}
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
{{ ... }}{{ ... }}
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
{{ ... }}{{ ... }}
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
{{ ... }}{{ ... }}
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
{{ ... }}{{ ... }}
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
{{ ... }}Route::post('/car/{id}/comment', [CarController::class, 'storeComment'])->name('storeComment');Route::post('/car/{id}/comment', [CarController::class, 'storeComment'])->name('storeComment');public function marketplace()
{
    $cars = Car::where('is_for_sale', true)
        ->with(['owner', 'comments.user'])
        ->orderBy('created_at', 'desc')
        ->get();
        
    return view('marketplace', compact('cars'));
}@foreach($cars as $car)
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
@endforeach<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_name');
            $table->integer('distance_travelled');
            $table->date('date_of_purchase');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
