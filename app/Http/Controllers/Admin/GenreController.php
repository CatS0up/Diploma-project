<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewGenreRequest;
use App\Models\Genre;
use App\Services\Book\Genre\GenreCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GenreController extends Controller
{
    private Genre $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function list(GenreCatalog $catalog): View
    {
        return view(
            'dashboard.genreList',
            [
                'genres' => $catalog->allPaginated(),
                'stats' => $catalog->stats()
            ]
        );
    }

    public function insert(NewGenreRequest $request): RedirectResponse
    {
        $this->genre->create($request->validated());

        return redirect()
            ->route('admin.get.genres')
            ->with('success', 'Gatunek został pomyslnie dodany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->genre->find($id)->delete();

        return redirect()
            ->route('admin.get.genres')
            ->with('success', 'Gatunek został usunięty pomyślnie.');
    }
}
