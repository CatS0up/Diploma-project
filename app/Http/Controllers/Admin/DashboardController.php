<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Services\Dashboard\AdminInfoService;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __invoke(AdminInfoService $info): View
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
