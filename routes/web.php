<?php

use App\Http\Controllers\ToDoToJai;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ToDoToJai::class,'index']);
Route::post('/todo',[ToDoToJai::class,'create']);
Route::put('/todo/{td_id}',[ToDoToJai::class,'edit']);
Route::delete('/todo/{td_id}',[ToDoToJai::class,'destroy']);