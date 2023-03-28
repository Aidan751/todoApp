<?php

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::put(
    'todos/update-order',
    function (Request $request) {


        $arr = $request->sortOrder;



        foreach ($arr as $key => $value) {
            $todo = Todo::find($value['id']);

            $todo->sort_id = $key + 1;
            $todo->save();

        }


        return response()->json(['success' => true]);
    }
);