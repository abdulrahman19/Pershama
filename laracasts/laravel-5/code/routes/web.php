<?php

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
    $tasks = [
        'task 1',
        'task 2',
        'task 3'
    ];
    return view('home', compact('tasks'));

    // return view('home', [
    //     'name' => 'Abdulrahman'
    // ]);

    //return view('home')->with('name','world');
});
