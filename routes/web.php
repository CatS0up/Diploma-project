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
    ->group(function () {

        Route::get('index', function () {
            return view('dashboard.index');
        })
            ->name('index');

        Route::get('users', function () {
            return view('dashboard.userList');
        })
            ->name('get.users');

        Route::get('users/{id}', function () {
            return view('dashboard.userProfile');
        })
            ->name('show.user');

        Route::get('books', function () {
            return view('dashboard.bookList');
        })
            ->name('get.books');

        Route::get('books/new', function () {
            return view('dashboard.addBook');
        })
            ->name('add.book');
    });
