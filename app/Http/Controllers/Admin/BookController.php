<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Repository\BookRepository;
use App\Repository\Filterable;
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
            [
                'sort' => Filterable::SORT_DEFAULT,
                'publisher' => BookRepository::PUBLISHER_ALL,
                'genre' => BookRepository::GENRE_ALL
            ]
        );

        return view('dashboard.bookList', [
            'books' => $this->bookResposiotry->filterBy($filters),
            'stats' => $this->bookResposiotry->stats(),
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

        if (isset($data['cover']))
            $data['cover'] = $file->savePublic('covers', $request['cover']);

        $data['pdf'] = $file->saveLocal('pdfs', $request['pdf']);

        $this->bookResposiotry->create($data);

        return redirect()->route('admin.get.books')
            ->with('success', 'Nowa książka została dodana.');
    }

    public function edit(PublisherRepository $publisherRepository, int $id): View
    {
        return view('dashboard.editBook', [
            'book' => $this->bookResposiotry->get($id),
            'publishers' => $publisherRepository->all()
        ]);
    }

    public function update(UpdateBookRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['avatar'])) {
            $path = $data['avatar']->store('avatars', 'public');

            Storage::disk('public')->delete($this->userRepository->get($id)->avatar);
            $data['avatar'] = $path;
        } else if ($data['reset_avatar'] == 'true') {
            $user = $this->userRepository->get($id);
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();
        }

        $data['id'] = $id;

        $this->userRepository->update($data);

        return redirect()
            ->route(
                'admin.show.user',
                ['id' => $id]
            )->with('success', 'Profil użytkownika został zaktualizowany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->bookResposiotry->delete($id);

        return redirect()->route('admin.get.books')
            ->with('success', 'Książka została pomyślnie usunięta.');
    }
}
