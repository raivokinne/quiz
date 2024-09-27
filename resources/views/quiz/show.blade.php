<x-app-layout>
    <div class="container w-full flex justify-center items-center mt-8">
        <form action="{{ route('quiz.submit') }}" method="POST">
            @csrf
            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-2">Question {{ Session::get('current_question_index') + 1 }}</h2>
                <p class="text-lg">{{ $question->question }}</p>
            </div>
            @foreach ($answers as $answer)
                <div class="mb-4 flex items-center gap-2">
                    <input type="radio" id="answer_{{ $answer->id }}" name="answer" value="{{ $answer->answer }}"
                        class="form-radio h-5 w-5 text-blue-600" required>
                    <label for="answer_{{ $answer->id }}" class="ml-2 text-white">{{ $answer->answer }}</label>
                </div>
            @endforeach
            <button type="submit" class="mt-4 bg-black border-2 border-white text-white font-bold py-2 px-4 rounded">
                Submit Answer
            </button>
        </form>
    </div>
</x-app-layout>
