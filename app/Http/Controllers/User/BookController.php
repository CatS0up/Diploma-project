<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Services\Book\BookFilteredList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookController extends Controller
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function list(
        Request $request,
        BookFilteredList $list,
        string $uid
    ): View {
        $expectedFilters = ['q', 'genre', 'publisher', 'sort', 'user_id'];

        $filters = $request->only($expectedFilters);

        $filters['user_id'] = $this->user->firstWhere('uid', $uid)->id;

        return view('user.list', [
            'books' => $list->setFilters($filters)
                ->qualifyFilters($expectedFilters)
                ->filter(),
            'inputValues' => $list->inputValues(),
            'filters' => $list->filters(),
            'current_user' => $uid
        ]);
    }

    public function add(Book $book, string $slug): RedirectResponse
    {
        Auth::user()->addBook($book->firstWhere('slug', $slug));

        return back()
            ->with('success', 'Książka zostałą dodana do twojej biblioteki.');
    }

    public function remove(Book $book, string $slug): RedirectResponse
    {
        Auth::user()->removeBook($book->firstWhere('slug', $slug));

        return back()
            ->with('success', 'Książka zostałą usunięta z twojej bilbioteki.');
    }
}
