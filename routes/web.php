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
    ->middleware(['auth', 'can:admin-level'])
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {

        Route::get('home', 'DashboardController')
            ->name('index');

        Route::middleware('VerifyUserExist')
            ->get('users/{id}', 'UserController@show')
            ->name('show.user');

        Route::middleware('VerifyUserExist')
            ->get('users/{id}/edit', 'UserController@edit')
            ->name('edit.user');

        Route::put('users/{id}/edit', 'UserController@update')
            ->name('update.user');

        Route::get('users', 'UserController@list')
            ->name('get.users');

        Route::delete('users/{id}', 'UserController@destroy')
            ->name('delete.user');

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

        Route::post('genres/new', 'GenreController@insert')
            ->name('insert.genre');

        Route::delete('genres/{id}', 'GenreController@destroy')
            ->name('delete.genre');
    });

/* ===> USER-LEVEL/GUEST-LEVEL ROUTES <=== */
Route::name('book.')
    ->namespace('Book')
    ->group(function () {

        Route::get('books', 'BookController@list')
            ->name('get.books');

        Route::get('books/{id}', 'BookController@show')
            ->name('show');

        Route::middleware('auth')
            ->get('books/{id}/download', 'BookController@download')
            ->name('download');
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

        Route::get('logout', 'LoginController@logout')
            ->name('logout');

        Route::get('register', 'RegisterController@create')
            ->name('register.form');

        Route::post('register', 'RegisterController@register')
            ->name('register');
    });
