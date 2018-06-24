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
    return view('home');
});

Auth::routes();

# Administrator
Route::middleware(['auth'])->group(function () {
    # Admin home
    Route::get('/admin', 'AdminController@index')->name('admin');

    # Tasks
    Route::get('/tasks', 'TaskController@index')->name('tasks');
    Route::get('/tasks/{task}', 'TaskController@show');

    # Posts
    Route::get('/posts', 'PostsController@index')->name('posts');
    Route::get('/posts/create', 'PostsController@create');
    Route::get('/posts/{post}', 'PostsController@show');
    Route::post('/posts', 'PostsController@store');

    # Comments
    Route::post('/posts/{post}/comments', 'CommentsController@store');
});

