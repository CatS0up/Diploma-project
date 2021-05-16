<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountDataRequest;
use App\Http\Requests\UserUpdateByAdminRequest;
use App\Repository\Filterable;
use App\Repository\UserRepository;
use App\Service\FiltersFormatter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(int $id): View|Response
    {
        $user = $this->userRepository->get($id);

        return view(
            'dashboard.userProfile',
            ['user' => $user]
        );
    }

    public function list(FiltersFormatter $filtersFormatter): View
    {
        $filters = $filtersFormatter->format(
            ['q', 'sort'],
            ['sort' => Filterable::SORT_DEFAULT]
        );
        return view(
            'dashboard.userList',
            [
                'users' => $this->userRepository->filterBy($filters),
                'privilagedUsers' => $this->userRepository->allPrivilaged(),
                'stats' => $this->userRepository->stats(),
                'filters' => $filters
            ]
        );
    }

    public function edit(int $id): View
    {
        return view(
            'dashboard.editUser',
            ['user' => $this->userRepository->get($id)]
        );
    }

    public function update(UserUpdateByAdminRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();
        $data['id'] = $id;

        $this->userRepository->update($data);

        return redirect()
            ->route(
                'admin.show.user',
                ['id' => $id]
            );
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->userRepository->delete($id);

        return back();
    }
}
