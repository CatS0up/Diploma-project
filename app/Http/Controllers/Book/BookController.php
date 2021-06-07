<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\Book\BookFilteredList;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    private Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function show(AuthManager $auth, string $slug): View
    {
        $user = $auth->user();

        $book = $this->book->firstWhere('slug', $slug);

        return view('book.show', [
            'book' => $book,
            'reviews' => $book->reviews()->with('user')->paginate(5),
            'userHasBook' => !isset($user) ?: $user->hasBook($book->id)
        ]);
    }

    public function list(Request $request, BookFilteredList $list): View
    {
        $expectedFilters = ['q', 'genre', 'publisher', 'sort'];

        $filters = $request->only($expectedFilters);

        return view('book.list', [
            'books' => $list->setFilters($filters)
                ->qualifyFilters($expectedFilters)
                ->filter(),
            'inputValues' => $list->inputValues(),
            'filters' => $list->filters(),
            'activeGenre' => $request->query('genre')
        ]);
    }
}
