<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\Book\BookService;
use App\Service\User\UserLibraryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    private UserLibraryService $userLibrary;
    private BookService $book;

    public function __construct(
        UserLibraryService $userLibrary,
        BookService $book
    ) {
        $this->userLibrary = $userLibrary;
        $this->book = $book;
    }

    public function list(): View
    {
        return view('me.list', ['books' => $this->userLibrary->allPaginated()]);
    }

    public function add(string $slug): RedirectResponse
    {
        $this->userLibrary->addBook($this->book->findBySlug($slug));

        return redirect()
            ->route('book.show', ['slug' => $slug])
            ->with('success', 'Książka zostałą dodana do twojej biblioteki.');
    }

    public function remove(string $slug): RedirectResponse
    {
        $this->userLibrary->removeBook($this->book->findBySlug($slug));

        return redirect()
            ->route('book.show', ['slug' => $slug])
            ->with('success', 'Książka zostałą usunięta z twojej bilbioteki.');
    }
}
