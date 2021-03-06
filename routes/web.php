<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\DownloadController;
use App\Http\Controllers\Book\ReviewController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\ProfileController;
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

Route::group([
    'prefix'     => 'admin',
    'middleware' => ['auth', 'can:admin-level'],
    'as'         => 'admin.'
], function () {

    Route::get('home', DashboardController::class)
        ->name('index');

    Route::group(['middleware' => 'verifyUserExist'], function () {
        Route::get('users/{id}', [UserController::class, 'show'])
            ->name('show.user');

        Route::get('users/{id}/edit', [UserController::class, 'edit'])
            ->name('edit.user');

        Route::put('users/{id}/edit', [UserController::class, 'update'])
            ->name('update.user');

        Route::delete('users/{id}', [UserController::class, 'destroy'])
            ->name('delete.user');
    });

    Route::get('users', [UserController::class, 'list'])
        ->name('get.users');

    Route::get('books', [AdminBookController::class, 'list'])
        ->name('get.books');

    Route::get('books/new', [AdminBookController::class, 'create'])
        ->name('add.book');

    Route::post('books/new', [AdminBookController::class, 'insert'])
        ->name('insert.book');

    Route::get('books/{id}/edit', [AdminBookController::class, 'edit'])
        ->name('edit.book');

    Route::put('books/{id}/edit', [AdminBookController::class, 'update'])
        ->name('update.book');

    Route::delete('books/{id}', [AdminBookController::class, 'destroy'])
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

    Route::get('authors', [AuthorController::class, 'list'])
        ->name('get.authors');

    Route::post('authors/new', [AuthorController::class, 'insert'])
        ->name('insert.author');

    Route::delete('authors/{id}', [AuthorController::class, 'destroy'])
        ->name('delete.author');

    Route::get('publishers', [PublisherController::class, 'list'])
        ->name('get.publishers');

    Route::post('publishers/new', [PublisherController::class, 'insert'])
        ->name('insert.publisher');

    Route::delete('publishers/{id}', [PublisherController::class, 'destroy'])
        ->name('delete.publisher');
});

/* ===> GUEST-LEVEL ROUTES <=== */
Route::group([
    'prefix' => 'books',
    'as'     => 'book.'
], function () {

    Route::get('books', [BookController::class, 'list'])
        ->name('get.books');

    Route::group(['middleware' => 'verifyBookExist'], function () {
        Route::get('{slug}', [BookController::class, 'show'])
            ->name('show');

        Route::middleware('auth')
            ->get('{slug}/download', DownloadController::class)
            ->name('download');

        /* ===> REVIEWS ROUTES <=== */
        Route::group([
            'middleware' => 'auth',
            'as'         => 'reviews'
        ], function () {

            Route::post('books/{slug}/reviews/new', [ReviewController::class, 'add'])
                ->middleware('verifyCommentAuthor')
                ->name('add');

            Route::delete('books/{slug}/reviews/{id}/delete', [ReviewController::class, 'destroy'])
                ->name('delete');
        });
    });
});

/* ===> PROFILE ROUTES <=== */
Route::group([
    'prefix'     => 'users',
    'middleware' => ['auth', 'verifyUserExist'],
    'as'         => 'profile.'
], function () {

    Route::get('{uid}', [ProfileController::class, 'show'])
        ->name('show');

    Route::get('{uid}/edit', [ProfileController::class, 'edit'])
        ->name('edit');

    Route::put('{uid}/edit', [ProfileController::class, 'update'])
        ->name('update');

    Route::delete('{uid}/delete', [ProfileController::class, 'destroy'])
        ->name('delete');;
});

/* ===> LOGGED USER ROUTES <=== */
Route::group([
    'prefix'     => 'user',
    'middleware' => 'auth',
    'as'         => 'user.'
], function () {

    Route::get('{uid}/books', [UserBookController::class, 'list'])
        ->name('get.books');

    Route::post('books/{slug}/add', [UserBookController::class, 'add'])
        ->name('add.book');

    Route::delete('books/{slug}/remove', [UserBookController::class, 'remove'])
        ->name('remove.book');
});

/* ===> AUTH ROUTES <=== */
Route::group(
    [
        'prefix' => 'auth',
        'as'     => 'auth.'
    ],
    function () {

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
    }
);
