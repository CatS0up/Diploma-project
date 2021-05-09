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

/* ===> ADMIN-LEVEL ROUTES <=== */

Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {

        Route::get('home', 'DashboardController')
            ->name('index');

        Route::get('users/{id}', 'UserController@show')
            ->name('show.user');

        Route::get('users/{id}/edit', 'UserController@edit')
            ->name('edit.user');

        Route::get('users', 'UserController@list')
            ->name('get.users');

        Route::get('books', 'BookController@list')
            ->name('get.books');

        Route::get('books/new', 'BookController@create')
            ->name('add.book');

        Route::get('books/{id}', 'BookController@show')
            ->name('show.book');
    });

/* ===> USER-LEVEL/GUEST-LEVEL ROUTES <=== */
Route::name('books.')
    ->namespace('Book')
    ->group(function () {

        Route::get('books', 'BookController@list')
            ->name('show.book');
    });

// TEMPORARY Routes

Route::get('auth/login', function () {
    return view('auth.login');
});

Route::get('auth/register', function () {
    return view('auth.register');
});
