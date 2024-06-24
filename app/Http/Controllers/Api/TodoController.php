<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    function getTodos() {
        return TodoResource::collection(Todo::all());
    }



    function storeTodo(Request $request) {
        $todo = Todo::create([
            'task' => $request->task,
            'done' => false,
        ]);

        return response()->json([
            'status'=> true,
            'data' => ['id'=>$todo->id]
        ]);
    }


    function doneTodo($id) {
        $todo = Todo::findOrFail($id);
        $todo->update(['done'=> !$todo->done]);

        return response()->json([
            'status' => true
        ]);
    }

    function deleteTodo($id) {
        Todo::findOrFail($id)->delete();

        return response()->json([
            'status'=> true,
        ]);
    }

    function updateTodo($id,Request $request) {
        $todo = Todo::findOrFail($id);
        $todo->update(['task'=> $request->task]);

        return response()->json([
            'status'=> true,
        ]);
    }

}
