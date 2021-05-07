<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(int $id): View
    {
        return view('dashboard.userProfile');
    }

    public function list(): View
    {
        return view('dashboard.userList');
    }
}
