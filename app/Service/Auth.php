<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Auth\AuthManager;

class Auth
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function authenticate(array $data): bool
    {
        # code...
    }
}
