<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewGenreRequest;
use App\Service\Book\GenreService;
use App\Service\Book\ListingGenreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GenreController extends Controller
{
    private GenreService $genre;

    public function __construct(GenreService $genre)
    {
        $this->genre = $genre;
    }

    public function list(ListingGenreService $genreList): View
    {
        return view(
            'dashboard.genreList',
            [
                'genres' => $genreList->allPaginated(),
                'amount' => 2000
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
        $this->genre->delete($id);

        return redirect()
            ->route('admin.get.genres')
            ->with('success', 'Rekord został usunięty pomyślnie.');
    }
}
