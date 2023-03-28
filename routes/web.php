<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// clear completed todos
Route::put('todos/clear-completed', [TodoController::class, 'clearCompleted'])->name('todos.clear-completed');

Route::get('/todos/switch-modes', [TodoController::class, 'switchModes'])->name('todos.switch-modes');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('todos', TodoController::class);

Route::put('todos/{todo}/incomplete', [TodoController::class, 'incomplete'])->name('todos.mark-as-incomplete');

Route::post('todos/update-order', [TodoController::class, 'updateOrder'])->name('todos.update-order');
