<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repository\UserRepository;
use App\Service\FileService;
use App\Service\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function register(
        RegisterRequest $request,
        UserService $user,
        FileService $file
    ): RedirectResponse {
        $data = $request->validated();

        if (isset($data['avatar']))
            $data['avatar'] = $file->savePublic('avatars', $data['avatar']);

        $user->create($data);

        return redirect()
            ->route('auth.login')
            ->with('success', 'Konto zostało pomyslnie utworzone.');
    }
}
