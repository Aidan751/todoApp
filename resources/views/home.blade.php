@extends('layouts.app')

@section('content')
    @auth
        <div class="p-0 mx-auto" style="max-width:540px;">
            <div class="row justify-content-center position-relative">
                <div>
                    <div class="d-flex justify-content-between align-items-center todo-container">
                        <h1 class="mb-0">TODO</h1>
                        <a href="{{ route('todos.switch-modes') }}" class="icon">

                        </a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body m-0 p-0">
                            <form class="m-0 p-0" action="{{ route('todos.store') }}" method="POST">
                                @csrf
                                <div class="todo-item">
                                    <input type="text" name="title" placeholder="Create a new todo..."
                                        class="todo-input p-0" autocomplete="off">
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (auth()->user()->todos->count() > 0)
                        <div class="card">
                            <div class="card-body m-0 p-0 sort_menu">
                                @foreach ($todos as $todo)
                                    <div class="todo-item" id="{{ $todo->sort_id }}" data-id="{{ $todo->id }}">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <form
                                                action="{{ !$todo->completed ? route('todos.update', $todo->id) : route('todos.mark-as-incomplete', $todo->id) }}"
                                                method="POST" class="d-flex align-items-center">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="completed" value="{{ $todo->completed ? 0 : 1 }}">
                                                @if ($todo->completed)
                                                    <button type="submit" class="btn p-0 complete-button position-relative">
                                                        <i class="fa-regular fa-circle-check d-block"></i>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn p-0 incomplete-button">
                                                        <i class="far fa-circle d-block"></i>
                                                    </button>
                                                @endif
                                                <button type="submit"
                                                    class="mb-0 todo-title {{ $todo->completed ? 'completed' : '' }}">
                                                    {{ ucfirst($todo->title) }}
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0">
                                                    <img src="{{ asset('img/icon-cross.svg') }}" alt="delete todo">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="d-flex align-items-center justify-content-between todo-item">
                                    <div class="todo-count">
                                        {{ auth()->user()->activeTodos()->count() }} items left
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('home') }}"
                                            class="btn p-0 me-2 selections {{ session('active') === 'all' ? 'active' : 'inactive' }}"
                                            type="submit">All</a>

                                        <a href="{{ route('home', ['completed' => 0]) }}"
                                            class="btn p-0 me-2 selections {{ session('active') === 'active' ? 'active' : 'inactive' }}"
                                            type="submit">Active</a>

                                        <a href="{{ route('home', ['completed' => 1]) }}"
                                            class="btn p-0 selections {{ session('active') === 'completed' ? 'active' : 'inactive' }}"
                                            type="submit">Completed</a>
                                    </div>
                                    <div>
                                        <form action="{{ route('todos.clear-completed') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn p-0 selections">Clear Completed</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container text-center py-5">
                            Drag and drop to reorder list
                        </div>
                    @else
                        <div class="container text-center pt-5 text-white">
                            <div class="card">
                                <div class="card-body no-todos">
                                    You have no todos.
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    @else
        <div class="container text-center pt-5 text-white">
            Sign in to your account to access your todos.
        </div>
    @endauth
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {

            var target = $('.sort_menu');


            target.sortable({
                update: function(event, ui) {
                    var sortData = Array.from(target.children()).map(function(child) {
                        return {
                            id: child.dataset.id,
                            sort_id: child.id
                        }
                    })

                    sortData.pop();

                    axios
                        .put("api/todos/update-order", {
                            sortOrder: sortData,
                            user_id: {{ auth()->user()->id }}
                        })
                        .then((response) => {
                            console.log(response);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            });

        })
    </script>
@endsection
