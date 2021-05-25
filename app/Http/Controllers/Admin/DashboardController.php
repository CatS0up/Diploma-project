<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __invoke(DashboardService $dashboard): View
    {
        return view('dashboard.index', [
            'stats' => $dashboard->getStats(),
            'latest' => $dashboard->getLatest()
        ]);
    }
}
