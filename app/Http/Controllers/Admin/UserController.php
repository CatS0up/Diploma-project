<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateByAdminRequest;
use App\Service\FiltersFormatter;
use App\Service\User\ListingService;
use App\Service\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserService $user;
    private ListingService $userList;

    public function __construct(UserService $user, ListingService $userList)
    {
        $this->user = $user;
        $this->userList = $userList;
    }

    public function show(int $id): View
    {
        return view(
            'dashboard.userProfile',
            ['user' => $this->user->findById($id)]
        );
    }

    public function list(FiltersFormatter $filtersFormatter): View
    {
        $filters = $filtersFormatter->format(
            ['q', 'sort'],
            ['sort' => 'asc']
        );
        return view(
            'dashboard.userList',
            [
                'users' => $this->userList->filterBy($filters),
                'privilaged' => $this->userList->allPrivilaged(),
                'stats' => $this->userList->stats(),
                'filters' => $filters
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
