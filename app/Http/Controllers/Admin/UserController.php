<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(int $id): View
    {
        return view('dashboard.userProfile');
    }

    public function list(): View
    {
        return view(
            'dashboard.userList',
            ['users' => $this->userRepository->allNormal()]
        );
    }

    public function edit(int $id): View
    {
        return view('dashboard.editUser');
    }
}
