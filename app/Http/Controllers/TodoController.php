<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTodoRequest $request)
    {
        Todo::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'sort_id' => Todo::max('sort_id') + 1
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update([
            'completed' => $request->has('completed')
        ]);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('home');
    }

    public function incomplete(Todo $todo)
    {
        $todo->update([
            'completed' => false
        ]);

        return redirect()->route('home');
    }

    public function completed()
    {
        $todos = auth()->user()->completedTodos()->get();

        return view('home', compact('todos'));
    }

    public function active()
    {
        $todos = auth()->user()->activeTodos()->get();

        return view('home', compact('todos'));
    }

    public function clearCompleted()
    {
        $todos = auth()->user()->completedTodos()->get();

        $todos->each->delete();

        return redirect()->back();
    }

    public function switchModes()
    {
        if (session()->has('isDark')) {
            session()->put('isDark', !session('isDark'));
        } else {
            //provide an initial value of isDark
            session()->put('isDark', true);
        }
        return redirect()->route('home');
    }
}