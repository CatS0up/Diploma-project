<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Publisher;
use App\Services\Book\BookCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function show(Book $book, int $id): View
    {
        return view('dashboard.bookItem', ['book' => $book->find($id)]);
    }

    public function list(
        Request $request,
        BookCatalog $catalog
    ): View {
        $expectedFilters = ['q', 'genre', 'publisher', 'sort'];

        $filters = $request->only($expectedFilters);

        return view('dashboard.bookList', [
            'books' => $catalog->allFiltered($filters, $expectedFilters),
            'inputValues' => $catalog->inputValues(),
            'filters' => $catalog->filters(),
            'stats' => $catalog->stats(),
        ]);
    }

    public function create(Publisher $publisher): View
    {
        return view('dashboard.addBook', ['publishers' => $publisher->get()]);
    }

    public function insert(NewBookRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->book->create($data);

        return redirect()->route('admin.get.books')
            ->with('success', 'Nowa książka została dodana.');
    }

    public function edit(Publisher $publisher, int $id): View
    {
        return view('dashboard.editBook', [
            'book' => $this->book->findById($id),
            'publishers' => $publisher->get()
        ]);
    }

    public function update(UpdateBookRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $this->book->update($id, $data);

        return redirect()
            ->route(
                'admin.show.book',
                ['id' => $id]
            )->with('success', 'Profil użytkownika został zaktualizowany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->book->delete($id);

        return redirect()->route('admin.get.books')
            ->with('success', 'Książka została pomyślnie usunięta.');
    }
}
