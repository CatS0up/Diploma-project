<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\AdminInfo;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __invoke(AdminInfo $info): View
    {
        return view('dashboard.index', [
            'countStats' => $info->countStats(),
            'latest' => [
                'users' => $info->getLatest('users'),
                'books' => $info->getLatest('books'),
            ]
        ]);
    }
}
