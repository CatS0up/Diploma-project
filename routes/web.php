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

/* HOME */

Route::get('/', 'Book\BookController@list')
    ->name('home');

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

        Route::post('books/new', 'BookController@insert')
            ->name('insert.book');

        Route::get('books/{id}', 'BookController@show')
            ->name('show.book');

        Route::get('genres', 'GenreController@list')
            ->name('get.genres');
    });

/* ===> USER-LEVEL/GUEST-LEVEL ROUTES <=== */
Route::name('book.')
    ->namespace('Book')
    ->group(function () {

        Route::get('books', 'BookController@list');
    });

/* ===> AUTH ROUTES <=== */
Route::prefix('auth')
    ->name('auth.')
    ->namespace('Auth')
    ->group(function () {

        // Route::get('login', 'Login');
        Route::get('login', 'LoginController@login')
            ->name('login.form');

        Route::post('login', 'LoginController@authenticate')
            ->name('login');

        Route::get('register', 'RegisterController@create')
            ->name('register.form');

        Route::post('register', 'RegisterController@register')
            ->name('register');
    });
