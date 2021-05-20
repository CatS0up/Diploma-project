<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private UserRepository $userRepostiory;

    public function __construct(UserRepository $userRepostiory)
    {
        $this->userRepostiory = $userRepostiory;
    }

    public function show(int $id): View
    {
        return view('user.profile', ['user' => $this->userRepostiory->get($id)]);
    }
}
