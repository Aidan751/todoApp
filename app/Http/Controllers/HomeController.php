<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->has('completed') && $request->completed == 1) {
            $todos = auth()->user()->completedTodos()->orderBy('sort_id', 'asc')->get();
            session()->put('active', 'completed');
        } else if ($request->has('completed') && $request->completed == 0) {
            $todos = auth()->user()->activeTodos()->orderBy('sort_id', 'asc')->get();
            session()->put('active', 'active');
        } else {
            $todos = auth()->user()->todos()->orderBy('sort_id', 'asc')->get();
            session()->put('active', 'all');
        }



        return view('home', compact('todos'));
    }
}
