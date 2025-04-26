<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;


class TodoController extends Controller
{
    public function index() {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request) {
        $request->validate(['title' => 'required']);
        Todo::create($request->only('title'));
        return redirect('/');
    }

    public function update(Request $request, $id) {
        $todo = Todo::findOrFail($id);
        $todo->update(['completed' => !$todo->completed]);
        return redirect('/');
    }

    public function destroy($id) {
        Todo::destroy($id);
        return redirect('/');
    }
}
