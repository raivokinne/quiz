<x-app-layout>
    <div class="container mx-auto max-w-3xl mt-12 px-4">
        <div class="flex items-center justify-center gap-6 mb-12">
            @foreach ($questionResults as $index => $result)
                <div
                    class="w-6 h-6 rounded-full
                    {{ $index < $currentIndex ? ($result['is_correct'] ? 'bg-green-500' : 'bg-red-500') : 'bg-gray-200' }}">
                </div>
            @endforeach
        </div>

        <form action="{{ route('quiz.submit') }}" method="POST">
            @csrf
            <div class="mb-10 w-full text-center">
                <h2 class="text-4xl font-bold mb-4">Question {{ $currentIndex + 1 }}</h2>
                <p class="text-2xl">{{ $question->question }}</p>
            </div>

            <div class="w-full grid grid-cols-2 gap-6">
                @foreach ($answers as $answer)
                    <div class="relative">
                        <input type="radio" id="answer_{{ $answer->id }}" name="answer" value="{{ $answer->id }}"
                            class="peer sr-only" required>
                        <label for="answer_{{ $answer->id }}"
                            class="block w-full h-full p-6 bg-black border-4 border-white rounded-lg cursor-pointer
                                      transition-all duration-200 ease-in-out
                                      peer-checked:bg-orange-400 peer-checked:border-white hover:bg-gray-800">
                            <span class="text-xl text-white">{{ $answer->answer }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit"
                class="mt-10 w-full bg-black border-4 border-white text-white text-2xl font-bold py-4 px-6
                           rounded-lg hover:bg-orange-400 transition-colors duration-200">
                Submit Answer
            </button>
        </form>
    </div>
</x-app-layout>
