<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group(['midleware' => [
    'auth:sanctum',
    'verified'
]], function () {

    Route::get('/todos' , function () {
        return view('frontend.todos');
    })->name('todos');


    Route::get('/users' , function () {
        return view('backend.users');
    })->middleware('admin')->name('users');


});
