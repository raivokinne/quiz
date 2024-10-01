<x-app-layout>
    @if (count($topics) > 0)
        <div class="relative mt-12 w-full max-w-lg sm:mt-10">
            <div class="relative -mb-px h-px w-full bg-gradient-to-r from-transparent via-sky-300 to-transparent"></div>
            <div
                class="mx-5 border dark:border-b-white/50 dark:border-t-white/50 border-b-white/20 sm:border-t-white/20 shadow-[20px_0_20px_20px] shadow-slate-500/10 dark:shadow-white/20 rounded-lg border-white/20 border-l-white/20 border-r-white/20 sm:shadow-sm lg:rounded-xl lg:shadow-none">
                <div class="flex flex-col p-6">
                    <div class="flex justify-center items-center">
                        <h3 class="text-xl font-semibold leading-6 tracking-tighter">EDIT a Quiz Topic</h3>
                    </div>
                    <div>
                        <p class="mt-1.5 text-sm font-medium text-white">Choose a topic:</p>

                        <!-- Corrected form with absolute path -->
                        <form method="POST" action="{{ url('/quiz/choose') }}">
                            @csrf
                            <div class="mt-4">
                                <select name="quiz_topic"
                                    class="w-full p-2 rounded border border-white bg-gray-800 text-white">
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                                    EDIT Quiz
                                </button>
                            </div>
                        </form>

                        <!-- Corrected form for creating a quiz -->
                        <form action="{{ url('/quiz/create') }}">
                            <div class="mt-4">
                                <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                                    CREATE Quiz
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
