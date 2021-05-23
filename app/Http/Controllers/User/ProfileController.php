<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\User\UserService;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private UserService $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function show(string $uid): View
    {
        return view(
            'user.profile',
            ['user' => $this->user->findByUid($uid)]
        );
    }
}
