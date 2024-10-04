<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-4xl font-bold text-center text-gray-200 mb-8">Select a Topic to View the Leaderboard</h1>

        <div class="flex justify-center">
            <div class="w-full sm:w-1/2">
                <form method="GET" action="{{ route('leaderboard.show')  }}">
                <label for="topic" class="block text-gray-300 text-lg mb-2">Choose a Topic:</label>
                <select name="topic" class="block w-full bg-gray-800 text-gray-300 border border-gray-700 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($topics as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>

                <!-- Button to View Leaderboard -->
                <button  class="mt-4 w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                    View Leaderboard
                </button>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
