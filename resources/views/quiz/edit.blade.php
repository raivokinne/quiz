<x-app-layout>
    <h1 class="text-4xl my-5 mt-20 font-bold">Edit Quiz</h1>

    <div class="mb-5 mx-5 border p-3 rounded-lg shadow w-[500px]">
        <form method="POST" action="/quiz/edit/{{ $quizID }}/update" class="my-5 mx-5 p-3 ">
            @csrf

            <!-- Quiz Category -->
            <div class="my-4">
                <label for="category" class="font-bold text-2xl">Quiz Category</label>
                <input type="text" name="category" id="category" value="{{ $quiz['category'] }}"
                    class="mt-2 w-full rounded focus-within:border-sky-200 border p-2 bg-transparent text-sm placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
                    required>
            </div>

            <!-- Quiz Questions and Answers -->
            @foreach ($quiz['questions'] as $index => $questions)
                <div class="my-4">
                    <!-- Hidden input to send question ID -->
                    <input type="hidden" name="questions[{{ $index }}][question_id]"
                        value="{{ $questions['question_id'] }}">

                    <label for="question_{{ $index }}" class="font-bold text-2xl">Question
                        {{ $index + 1 }}</label>
                    <input type="text" name="questions[{{ $index }}][question]"
                        id="question_{{ $index }}" value="{{ $questions['question'] }}"
                        class="mt-2 w-full rounded focus-within:border-sky-200 border p-2 bg-transparent text-sm placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
                        required>

                    <!-- Loop through answers -->
                    @foreach ($questions['answers'] as $answerIndex => $answer)
                        <span class="flex gap-1 font-bold my-3">
                            <input type="radio" name="questions[{{ $index }}][correct_answer]"
                                value="{{ $answerIndex }}"
                                {{ $questions['is_correct'][$answerIndex] ? 'checked' : '' }} required>
                            <input type="text" name="questions[{{ $index }}][answers][]"
                                value="{{ $answer }}" placeholder="Answer {{ $answerIndex + 1 }}"
                                class="answer_text w-full rounded focus-within:border-sky-200 border p-1 bg-transparent text-sm placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
                                required>
                        </span>
                    @endforeach
                </div>
            @endforeach

            <!-- Submit Button -->
            <button type="submit"
                class="mt-3 font-semibold hover:bg-black hover:text-white hover:ring hover:ring-white transition duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-white text-black h-10 px-4 py-2">
                Complete Editing
            </button>
        </form>
    </div>
</x-app-layout>
