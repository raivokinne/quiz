<script>
    let no_of_questions = 0;

    function addQuestion() {
        let node = document.createElement('div');
        node.className = 'question_options';
        node.innerHTML = `
        <div class=" mb-5 mx-5 border p-3 dark:border-b-white/50 dark:border-t-white/50 border-b-white/20 sm:border-t-white/20 shadow shadow-slate-500/10 dark:shadow-white/20 rounded-lg border-white/20 border-l-white/20 border-r-white/20 sm:shadow-sm lg:rounded-xl lg:shadow-none">

            <h3 class=" mb-3 text-lg font-semibold">Question ${no_of_questions + 1}</h3>

            <input
            placeholder="Question"
            type="text"
            name="question[]"
            class="question_input w-[200px] rounded focus-within:border-sky-200 border p-1 bg-transparent text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
            required>

        <span>
            <button
            id="delete_btn_${no_of_questions + 1}"
            class="font-semibold hover:bg-red-600 hover:text-white hover:ring hover:ring-white transition duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-white text-black h-10 px-4 py-2"
            onclick="deleteQuestion(this)">
            Delete</button>
        </span>

        <div class="grid grid-flow-row gap-3 mt-3 justify-center" >

            <span>
                <input
                type="radio"
                name="answer_${no_of_questions}"
                value="0"
                class="answer_input h-5 w-5 focus:ring-2"
                required>
                <input
                type="text"
                name="option_${no_of_questions}[]"
                placeholder="Answer 1"
                class="answer_text w-[200px] rounded focus-within:border-sky-200 border p-1 bg-transparent text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
                required>
            </span>

            <span>
                <input
                type="radio"
                name="answer_${no_of_questions}"
                value="1"
                class="answer_input h-5 w-5 focus:ring-2"
                >
                <input
                type="text"
                name="option_${no_of_questions}[]"
                placeholder="Answer 2"
                class="answer_text w-[200px] rounded focus-within:border-sky-200 border p-1 bg-transparent text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
                required>
            </span>

            <span>
                <input
                type="radio"
                name="answer_${no_of_questions}"
                value="2"
                class="answer_input h-5 w-5 focus:ring-2"
                >
                <input
                type="text"
                name="option_${no_of_questions}[]"
                placeholder="Answer 3"
                class="answer_text w-[200px] rounded focus-within:border-sky-200 border p-1 bg-transparent text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
                required>
            </span>

            <span>
                <input
                type="radio"
                name="answer_${no_of_questions}"
                value="3"
                class="answer_input h-5 w-5 focus:ring-2"
                >
                <input
                type="text"
                name="option_${no_of_questions}[]"
                placeholder="Answer 4"
                class="answer_text w-[200px] rounded focus-within:border-sky-200 border p-1 bg-transparent text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
                required>
            </span>
        </div>
        </div>
    `;

        document.getElementById('addQuizForm').appendChild(node);
        no_of_questions++;
    }
</script>

<x-app-layout>
    <div class="w-screen h-screen">
        <div class="grid grid-flow-row justify-center mt-10">
            <h1 class="my-7 text-3xl font-bold text-center">Make a Quiz</h1>

            <div class="grid justify-center">
                <form
                    class="grid justify-center mx-5 border p-3 dark:border-b-white/50 dark:border-t-white/50 border-b-white/20 sm:border-t-white/20 shadow shadow-slate-500/10 dark:shadow-white/20 rounded-lg border-white/20 border-l-white/20 border-r-white/20 sm:shadow-sm lg:rounded-xl lg:shadow-none"
                    method="POST" action="/quiz/create/store">
                    @csrf
                    <input type="text" placeholder="Quiz title" name="quiz_title"
                        class="mt-7 w-full rounded focus-within:border-sky-200 border p-1 bg-transparent text-sm file:my-1 placeholder:text-muted-foreground/90 focus:outline-none focus:ring-0 focus:ring-teal-500 sm:leading-7 text-foreground"
                        required>


                    <div id="addQuizForm"></div>

                    <button type="button" onclick="addQuestion()"
                        class="mt-7 font-semibold hover:bg-black hover:text-white hover:ring hover:ring-white transition duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-white text-black h-10 px-4 py-2">
                        Add Question
                    </button>

                    <button type="submit"
                        class="mt-3 font-semibold hover:bg-black hover:text-white hover:ring hover:ring-white transition duration-300 inline-flex items-center justify-center rounded-md text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-white text-black h-10 px-4 py-2">
                        Submit Quiz
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
