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

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show(string $uid): View
    {
        return view(
            'me.profile',
            ['user' => $this->user->firstWhere('uid', $uid)]
        );
    }

    public function edit(int $id): View
    {
        return view(
            'dashboard.editUser',
            ['user' => $this->user->find($id)]
        );
    }

    public function update(
        UserUpdateRequest $request,
        int $id
    ): RedirectResponse {

        $data = $request->validated();

        $this->userService->update($id, $data);

        return redirect()
            ->route(
                'admin.show.user',
                ['id' => $id]
            )->with('success', 'Profil użytkownika został zaktualizowany.');
    }

    public function destroy(UserService $userService, string $uid): RedirectResponse
    {
        $userService->delete($this->user->firstWhere('uid', $uid)->id);

        return redirect()
            ->route('home')
            ->with('success', 'Konto zostało usunięte.');
    }
}
