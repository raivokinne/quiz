<x-app-layout>
    <div class="container mx-auto mt-8 text-center">
        <h1 class="text-3xl font-bold mb-4">Quiz Results</h1>
        <p class="text-xl mb-2">Your Score: {{ $score }} out of {{ $totalQuestions }}</p>
        <p class="text-lg mb-4">
            Percentage: {{ number_format(($score / $totalQuestions) * 100, 2) }}%
        </p>
        <a href="{{ route('welcome') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Start New Quiz
        </a>
    </div>
</x-app-layout>
