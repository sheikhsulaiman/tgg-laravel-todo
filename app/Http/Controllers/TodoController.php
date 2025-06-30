<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $todos = auth()->user()->todos;
        return view('dashboard', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);

        auth()->user()->todos()->create([
            'title' => $request->title,
            'completed' => false,
        ]);

        return redirect('/dashboard');
    }

    public function update(Request $request, $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo->update(['completed' => !$todo->completed]);

        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo->delete();

        return redirect('/dashboard');
    }
}
