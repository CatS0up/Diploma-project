<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\User\BookController as UserBookController;
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

Route::get('/', [BookController::class, 'list'])
    ->name('home');

/* ==, ADMIN-LEVEL ROUTES <=== */
Route::prefix('admin')
    ->middleware(['auth', 'can:admin-level'])
    ->name('admin.')
    ->group(function () {

        Route::get('home', DashboardController::class)
            ->name('index');

        Route::middleware('VerifyUserExist')
            ->get('users/{id}', [UserController::class, 'show'])
            ->name('show.user');

        Route::middleware('VerifyUserExist')
            ->get('users/{id}/edit', [UserController::class, 'edit'])
            ->name('edit.user');

        Route::put('users/{id}/edit', [UserController::class, 'update'])
            ->name('update.user');

        Route::get('users', [UserController::class, 'list'])
            ->name('get.users');

        Route::delete('users/{id}', [UserController::class, 'destroy'])
            ->name('delete.user');

        Route::get('books', [AdminBookController::class, 'list'])
            ->name('get.books');

        Route::get('books/new', [AdminBookController::class, 'create'])
            ->name('add.book');

        Route::post('books/new', [AdminBookController::class, 'insert'])
            ->name('insert.book');

        Route::delete('books/{id}/delete', [AdminBookController::class, 'destroy'])
            ->name('delete.book');

        Route::get('books/{id}', [AdminBookController::class, 'show'])
            ->name('show.book');

        Route::get('books/{id}/edit', [AdminBookController::class, 'edit'])
            ->name('edit.book');

        Route::get('genres', [GenreController::class, 'list'])
            ->name('get.genres');

        Route::post('genres/new',  [GenreController::class, 'insert'])
            ->name('insert.genre');

        Route::delete('genres/{id}',  [GenreController::class, 'destroy'])
            ->name('delete.genre');
    });

/* ==, GUEST-LEVEL ROUTES <=== */
Route::name('book.')
    ->group(function () {

        Route::get('books', [BookController::class, 'list'])
            ->name('get.books');

        Route::get('books/{id}', [BookController::class, 'show'])
            ->name('show');

        Route::middleware('auth')
            ->get('books/{id}/download', [BookController::class, 'download'])
            ->name('download');
    });

/* ===> LOGGED USER ROUTES <=== */
Route::prefix('me')
    ->middleware(['auth'])
    ->name('me.')
    ->group(function () {

        Route::get('books', [UserBookController::class, 'list'])
            ->name('get.books');

        Route::post('books/{id}/add', [UserBookController::class, 'add'])
            ->name('add.book');

        Route::post('books/{id}/remove', [UserBookController::class, 'remove'])
            ->name('remove.book');
    });

/* ===> AUTH ROUTES <=== */
Route::prefix('auth')
    ->name('auth.')
    ->group(function () {

        // Route::get('login', 'Login');
        Route::get('login', [LoginController::class, 'login'])
            ->name('login.form');

        Route::post('login', [LoginController::class, 'authenticate'])
            ->name('login');

        Route::get('logout', [LoginController::class, 'logout'])
            ->name('logout');

        Route::get('register', [RegisterController::class, 'create'])
            ->name('register.form');

        Route::post('register', [RegisterController::class, 'register'])
            ->name('register');
    });
