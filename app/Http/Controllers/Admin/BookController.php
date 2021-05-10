<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewBookRequest;
use Illuminate\View\View;

class BookController extends Controller
{
    public function show(int $id): View
    {
        return view('dashboard.bookItem');
    }

    public function list(): View
    {
        return view('dashboard.bookList');
    }

    public function create(): View
    {
        return view('dashboard.addBook');
    }

    public function insert(NewBookRequest $request): void
    {
        $data = $request->validated();
    }
}
