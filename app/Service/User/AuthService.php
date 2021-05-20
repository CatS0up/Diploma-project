<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\AuthManager;

class AuthService
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function authenticate(
        array $credentials,
        User $userModel
    ): bool {
        $user = $userModel->uid($credentials['uid'])->first();

        $user->actived_at = Carbon::now();
        $user->save();

        $this->authManager->loginUsingId($user->id);

        return (bool) $this->hasUser();
    }

    public function logout(): bool
    {
        $this->authManager->logout();

        return $this->hasUser();
    }

    private function hasUser(): bool
    {
        return (bool) $this->authManager->id();
    }
}
