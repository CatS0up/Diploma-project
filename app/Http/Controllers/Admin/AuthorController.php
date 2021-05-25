<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewAuthorRequest;
use App\Service\Book\AuthorService;
use App\Service\Book\ListingAuthorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    private AuthorService $author;

    public function __construct(AuthorService $author)
    {
        $this->author = $author;
    }

    public function list(ListingAuthorService $authorList): View
    {
        return view('dashboard.authorList', [
            'authors' => $authorList->allPaginated(),
            'stats' => $authorList->stats()
        ]);
    }

    public function insert(NewAuthorRequest $request): RedirectResponse
    {
        $this->author->createSingle($request->validated());

        return redirect()
            ->route('admin.get.authors')
            ->with('success', 'Autor został pomyślnie dodany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->author->delete($id);

        return redirect()
            ->route('admin.get.authors')
            ->with('success', 'Autor został pomyślnie usunięty.');
    }
}
