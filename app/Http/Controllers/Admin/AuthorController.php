<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewAuthorRequest;
use App\Models\Author;
use App\Services\Book\Author\AuthorCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    private Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function list(AuthorCatalog $catalog): View
    {
        return view(
            'dashboard.author.list',
            [
                'authors' => $catalog->allPaginated(),
                'stats' => $catalog->stats()
            ]
        );
    }

    public function insert(NewAuthorRequest $request): RedirectResponse
    {
        $this->author->firstOrCreate($request->validated());

        return redirect()
            ->route('admin.get.authors')
            ->with('success', 'Gatunek został pomyslnie dodany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->author->find($id)->delete();

        return redirect()
            ->route('admin.get.authors')
            ->with('success', 'Gatunek został usunięty pomyślnie.');
    }
}
