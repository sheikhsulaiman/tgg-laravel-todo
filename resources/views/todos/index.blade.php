<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Material 3 Todo App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f5f5f5] text-gray-900 min-h-screen flex justify-center items-start py-16 font-sans">

    <div class="w-full max-w-xl bg-white shadow-lg rounded-2xl p-8 space-y-6 border border-gray-100">
        <h1 class="text-3xl font-semibold text-center text-[#1a1a1a]">📝 My Todos</h1>

        {{-- Add Todo Form --}}
        <form method="POST" action="/todos" class="flex gap-3">
            @csrf
            <input
                type="text"
                name="title"
                placeholder="Add a new todo"
                class="flex-1 px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition"
            >
            <button
                type="submit"
                class="bg-primary text-white px-5 py-3 rounded-xl font-medium shadow hover:corsor-pointer hover:bg-primary-dark transition"
            >
                Add
            </button>
        </form>

        {{-- Todo List --}}
        <ul class="space-y-3">
            @foreach($todos as $todo)
                <li class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-5 py-4 shadow-sm hover:shadow-md transition">

                    {{-- Toggle Completion --}}
                    <form method="POST" action="/todos/{{ $todo->id }}" class="flex items-center gap-3 w-full">
                        @csrf
                        @method('PUT')
                        <input
                            type="checkbox"
                            onChange="this.form.submit()"
                            {{ $todo->completed ? 'checked' : '' }}
                            class="h-5 w-5 accent-primary hover:cursor-pointer transition"
                        >
                        <span class="flex-1 {{ $todo->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                            {{ $todo->title }}
                        </span>
                    </form>

                    {{-- Delete Button --}}
                    <form method="POST" action="/todos/{{ $todo->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center justify-center gap-1 text-red-500 hover:text-red-700 hover:cursor-pointer transition">
                            <div>🗑️</div><p>Delete</p>
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>
