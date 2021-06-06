<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateByAdminRequest;
use App\Models\User;
use App\Services\User\UserCatalog;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private User $user;
    private UserService $userService;

    public function __construct(User $user, UserService $userService)
    {
        $this->user = $user;
        $this->userService = $userService;
    }

    public function show(int $id): View
    {
        return view(
            'dashboard.userProfile',
            ['user' => $this->user->find($id)]
        );
    }

    public function list(Request $request, UserCatalog $catalog): View
    {
        $expectedFilters = ['q', 'sort', 'sort_by'];

        $filters = $request->only($expectedFilters);

        return view(
            'dashboard.userList',
            [
                'users' => $catalog->allFiltered($filters, $expectedFilters),
                'privilaged' => $this->user->privilaged()->get(),
                'stats' => $catalog->stats(),
                'filters' => $catalog->filters()
            ]
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
        UserUpdateByAdminRequest $request,
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

    public function destroy(int $id): RedirectResponse
    {
        $this->userService->delete($id);

        return back()->with('success', 'Użytkownik został pomyślnie usunięty.');
    }
}
