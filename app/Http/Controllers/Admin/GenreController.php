<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewGenreRequest;
use App\Repository\GenreRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GenreController extends Controller
{
    private GenreRepository $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function list(): View
    {
        return view(
            'dashboard.genreList',
            [
                'genres' => $this->genreRepository->allPaginated(),
                'amount' => $this->genreRepository->count()
            ]
        );
    }

    public function insert(NewGenreRequest $request): RedirectResponse
    {
        $this->genreRepository->create($request->validated()['genre']);

        return redirect()
            ->route('admin.get.genres')
            ->with('success', 'Gatunek został pomyslnie dodany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->genreRepository->delete($id);

        return redirect()
            ->route('admin.get.genres')
            ->with('success', 'Rekord został usunięty pomyślnie.');
    }
}
