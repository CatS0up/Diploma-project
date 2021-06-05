<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateByAdminRequest;
use App\Repositories\UserRepository;
use App\Services\User\UserListing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepository $userReposiotry;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(int $id): View
    {
        return view(
            'dashboard.userProfile',
            ['user' => $this->userRepository->findById($id)]
        );
    }

    public function list(Request $request, UserListing $userList): View
    {
        $expectedFilters = ['q', 'sort', 'sort_by'];

        $filters = $request->only($expectedFilters);

        return view(
            'dashboard.userList',
            [
                'users' => $userList->filteredUsers($filters, $expectedFilters),
                'privilaged' => $userList->allPrivilaged(),
                'stats' => $userList->stats(),
                'filters' => $userList->filters()
            ]
        );
    }

    public function edit(int $id): View
    {
        return view(
            'dashboard.editUser',
            ['user' => $this->user->findById($id)]
        );
    }

    public function update(UserUpdateByAdminRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $this->user->update($id, $data);

        return redirect()
            ->route(
                'admin.show.user',
                ['id' => $id]
            )->with('success', 'Profil użytkownika został zaktualizowany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->userRepository->delete($id);

        return back()->with('success', 'Użytkownik został pomyślnie usunięty.');
    }
}
