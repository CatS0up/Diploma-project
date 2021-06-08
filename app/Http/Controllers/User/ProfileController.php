<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private User $user;
    private UserService $userService;

    public function __construct(User $user, UserService $userService)
    {
        $this->user = $user;
        $this->userService = $userService;
    }

    public function show(string $uid): View
    {
        return view(
            'user.show',
            ['user' => $this->user->firstWhere('uid', $uid)]
        );
    }

    public function edit(string $uid): View
    {
        $user = $this->user->firstWhere('uid', $uid);

        $this->authorize('updateByUser', $user);

        return view(
            'user.edit',
            ['user' => $user]
        );
    }

    public function update(
        UserUpdateRequest $request,
        string $uid
    ): RedirectResponse {
        $user = $this->user->firstWhere('uid', $uid);

        $this->authorize('updateByUser', $user);

        $data = $request->validated();

        $this->userService->basicUpdate($user->id, $data);

        return redirect()
            ->route(
                'profile.show',
                ['uid' => $uid]
            )->with('success', 'Profil użytkownika został zaktualizowany.');
    }

    public function destroy(string $uid): RedirectResponse
    {
        $user = $this->user->firstWhere('uid', $uid);

        $this->authorize('delete', $user);

        $this->userService->delete($user->id);

        return redirect()
            ->route('home')
            ->with('success', 'Konto zostało usunięte.');
    }
}
