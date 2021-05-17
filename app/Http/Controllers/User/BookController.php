<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\BookRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookController extends Controller
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function list(): View
    {
        return view('me.list', ['books' => Auth::user()
            ->books()
            ->paginate()]);
    }

    public function add(int $id): RedirectResponse
    {
        Auth::user()
            ->addBook($this->bookRepository->get($id));

        return redirect()
            ->route('book.show', ['id' => $id])
            ->with('success', 'Książka zostałą dodana do twojej biblioteki.');
    }

    public function remove(int $id): RedirectResponse
    {
        Auth::user()
            ->removeBook($this->bookRepository->get($id));

        return redirect()
            ->route('book.show', ['id' => $id])
            ->with('success', 'Książka zostałą usunięta z twojej bilbioteki.');
    }
}
