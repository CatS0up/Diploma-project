<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Service\User\AuthService;

class LoginController extends Controller
{
    private AuthService $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(
        LoginRequest $request,
        User $userModel
    ): RedirectResponse {

        $this->auth->authenticate($request->validated(), $userModel);

        return redirect()
            ->route('home')
            ->with('success', 'Jesteś zalogowany.');
    }

    public function logout(): RedirectResponse
    {
        $this->auth->logout();

        return redirect()
            ->route('home')
            ->with('info', 'Zostałeś wylogowany.');
    }
}
