<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\GenreRepository;
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
            ['genres' => $this->genreRepository->allPaginated()]
        );
    }
}
