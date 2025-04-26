<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>
</head>
<body>
    <h1>Todo List</h1>
    <form method="POST" action="/todos">
        @csrf
        <input type="text" name="title" placeholder="Enter todo">
        <button type="submit">Add</button>
    </form>

    <ul>
        @foreach($todos as $todo)
            <li>
                <form method="POST" action="/todos/{{ $todo->id }}">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" onChange="this.form.submit()" {{ $todo->completed ? 'checked' : '' }}>
                    {{ $todo->title }}
                </form>
                <form method="POST" action="/todos/{{ $todo->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
