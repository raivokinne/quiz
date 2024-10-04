<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <!-- Display Category Name -->
        <h1 class="text-4xl font-bold text-center text-gray-200 mb-8">
            Leaderboard for {{ $category->name }}
        </h1>

        <!-- Check if there is any data to display -->
        @if($history->isEmpty())
            <p class="text-center text-gray-400">No data available for this topic.</p>
        @else
            <!-- Table for Leaderboard -->
            <div class="flex items-center justify-center min-h-[450px]">
                <div class="overflow-x-auto relative  border border-gray-600">
                    <table class="w-full text-xl text-left text-gray-200">
                        <thead class="text-sm bg-gray-700 text-gray-400 uppercase">
                        <tr>
                            <th class="py-3 px-8 border border-gray-600">Place</th>
                            <th class="py-3 px-16 border border-gray-600">User</th>
                            <th class="py-3 px-16 border border-gray-600">Points</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($history as $entry)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-800' : 'bg-gray-900' }}">
                                <!-- Display Rank/Place -->
                                <td class="py-2 px-8 border border-gray-600">{{ $loop->iteration }}</td>
                                <!-- Display User Name -->
                                <td class="py-2 px-16 border border-gray-600">{{ $entry->user->name }}</td>
                                <!-- Display Points -->
                                <td class="py-2 px-16 border border-gray-600">{{ $entry->point->points }}/15</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Back to Topic Selection -->
        <div class="mt-8 text-center">
            <a href="/leaderboard" class="text-blue-400 hover:underline">Choose another topic</a>
        </div>
    </div>
</x-app-layout>

