<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewBookRequest;
use App\Repository\BookRepository;
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
        return view('dashboard.bookItem');
    }

    public function list(): View
    {
        return view('dashboard.bookList', ['boo']);
    }

    public function create(): View
    {
        return view('dashboard.addBook');
    }

    public function insert(NewBookRequest $request): void
    {
        $data = $request->validated();

        $this->bookResposiotry->create($data);
    }
}
