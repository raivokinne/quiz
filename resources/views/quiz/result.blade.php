<x-app-layout>
    <div class="container mx-auto mt-20 p-4 max-w-4xl">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-4">Quiz Results</h1>
            <p class="text-2xl mb-2">Your Score: {{ $score }} out of {{ $totalQuestions }}</p>
        </div>

        <div class="mb-8">
            <h2 class="text-3xl font-bold mb-6">Question Review</h2>
            @foreach ($questionResults as $index => $result)
                <div
                    class="mb-6 p-6 border-2 rounded-lg shadow-md {{ $result['is_correct'] ? 'bg-green-50' : 'bg-red-50' }}">
                    <p class="font-bold text-xl mb-3 text-black">Question {{ $index + 1 }}: {{ $result['question'] }}
                    </p>
                    <div class="pl-4 border-l-4 {{ $result['is_correct'] ? 'border-green-500' : 'border-red-500' }}">
                        <p class="mb-2 text-black">
                            <span class="font-semibold">Your answer:</span>
                            {{ $result['selected_answer'] }}
                        </p>
                        <p class="mb-2 text-black">
                            <span class="font-semibold">Correct answer:</span>
                            {{ $result['correct_answer'] }}
                        </p>
                        <p class="font-bold {{ $result['is_correct'] ? 'text-green-600' : 'text-red-600' }}">
                            {{ $result['is_correct'] ? 'Correct' : 'Incorrect' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('welcome') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-xl
                      transition-colors duration-200">
                Start New Quiz
            </a>
        </div>
    </div>
</x-app-layout>
