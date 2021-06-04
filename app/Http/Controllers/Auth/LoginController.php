<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\Account\Authenticator;

class LoginController extends Controller
{
    private Authenticator $auth;

    public function __construct(Authenticator $auth)
    {
        $this->auth = $auth;
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(
        LoginRequest $request,
    ): RedirectResponse {

        $this->auth->apply($request->validated());

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
