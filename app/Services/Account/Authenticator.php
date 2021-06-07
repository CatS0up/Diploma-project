<?php

declare(strict_types=1);

namespace App\Services\Account;

use App\Models\User;
use Illuminate\Auth\AuthManager;

class Authenticator
{
    private AuthManager $auth;
    private User $user;

    public function __construct(AuthManager $auth, User $user)
    {
        $this->auth = $auth;
        $this->user = $user;
    }

    public function apply(array $credentials): bool
    {
        $this->auth->loginUsingId(
            $this->findUser($credentials['uid'])->id
        );

        return $this->userIsLogged();
    }

    public function logout(): bool
    {
        $this->auth->logout();

        return $this->userIsLogged();
    }

    private function findUser(string $uid): User
    {
        return $this->user
            ->uid($uid)
            ->first();
    }

    private function userIsLogged(): bool
    {
        return (bool) $this->auth->id();
    }
}
