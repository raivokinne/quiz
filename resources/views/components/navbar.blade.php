<nav class="bg-black p-4 top-0 w-full fixed">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/welcome" class="text-white text-lg font-bold">Quiz</a>
        <div>
            @auth
                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-300">Dashboard</a>
                @endif
            @endauth
        </div>
    </div>
</nav>
