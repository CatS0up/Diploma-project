<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class GenreController extends Controller
{
    public function list(): View
    {
        return view('auth.login');
    }
}
