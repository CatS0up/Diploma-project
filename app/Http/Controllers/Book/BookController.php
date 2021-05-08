<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BookController extends Controller
{
    public function show(int $id): View
    {
        return view('book.show');
    }

    public function list(): View
    {
        return view('book.list');
    }
}
