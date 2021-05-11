<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountDataRequest;
use App\Repository\UserRepository;
use Illuminate\Http\RedirectResponse;
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
        return view(
            'dashboard.userProfile',
            ['user' => $this->userRepository->get($id)]
        );
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
        return view(
            'dashboard.editUser',
            ['user' => $this->userRepository->get($id)]
        );
    }

    public function update(AccountDataRequest $request, int $id): RedirectResponse
    {
        return redirect()->route('admin.edit.user', ['id' => $id]);
    }
}
