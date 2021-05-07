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

// ADMIN-Level Routes
Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {

        Route::get('index', 'DashboardController')
            ->name('index');

        Route::get('users', 'UserController@list')
            ->name('get.users');

        Route::get('users/{id}', 'UserController@show')
            ->name('show.user');

        Route::get('books', 'BookController@list')
            ->name('get.books');

        Route::get('books/new', 'BookController@create')
            ->name('add.book');
    });
