<?php

use App\Http\Controllers\Api\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/todos', [TodoController::class,'getTodos']);
Route::post('/todos', [TodoController::class,'storeTodo']);
Route::delete('/todos/{id}', [TodoController::class,'deleteTodo']);
Route::patch('/todos/{id}', [TodoController::class,'doneTodo']);

