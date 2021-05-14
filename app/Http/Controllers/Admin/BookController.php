<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewBookRequest;
use App\Repository\BookRepository;
use App\Repository\GenreRepository;
use App\Repository\PublisherRepository;
use App\Service\FileService;
use App\Service\FiltersFormatter;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    private BookRepository $bookResposiotry;

    public function __construct(BookRepository $bookResposiotry)
    {
        $this->bookResposiotry = $bookResposiotry;
    }

    public function show(int $id): View
    {
        return view('dashboard.bookItem', ['book' => $this->bookResposiotry->get($id)]);
    }

    public function list(
        FiltersFormatter $filtersFormatter,
        PublisherRepository $publisherRepository,
        GenreRepository $genreRepository
    ): View {
        $filters = $filtersFormatter->format(
            ['q', 'publisher', 'genre', 'sort'],
            ['sort' => 'asc']
        );

        return view('dashboard.bookList', [
            'books' => $this->bookResposiotry->filterBy($filters),
            'publishers' => $publisherRepository->all(),
            'genres' => $genreRepository->all(),
            'filters' => $filters
        ]);
    }

    public function create(PublisherRepository $publisherRepository): View
    {
        return view('dashboard.addBook', ['publishers' => $publisherRepository->all()]);
    }

    public function insert(NewBookRequest $request, FileService $file): RedirectResponse
    {
        $data = $request->validated();

        $data['cover'] = $file->savePublic('covers', $request['cover']);
        $data['pdf'] = $file->saveLocal('pdfs', $request['pdf']);

        $this->bookResposiotry->create($data);

        return redirect()->route('admin.get.books');
    }
}
