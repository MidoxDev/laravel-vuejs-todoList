<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    function getTodos() {
        return TodoResource::collection(Todo::all());
    }



    function storeTodo(Request $request) {

        $validator = Validator::make($request->all(), [
            'task' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


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

        $validator = Validator::make(['task'=>$todo->task], [
            'task' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $todo->update(['task'=> $request->task]);

        return response()->json([
            'status'=> true,
        ]);
    }

}
