<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepository as UserRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function get(int $id): User
    {
        return $this->userModel->find($id);
    }

    public function all(): ?Collection
    {
        return $this->userModel->get() ?? [];
    }

    public function allPrivilaged(): Collection
    {
        return $this->userModel
            ->privilaged()
            ->get();
    }

    public function allNormal(): ?Collection
    {
        return $this->userModel
            ->normal()
            ->get() ?? [];
    }

    public function allPaginated(int $limit): Paginator
    {
        return $this->userModel->paginate($limit);
    }

    public function create(array $data): User
    {
        $this->userModel->uid = $data['uid'];
        $this->userModel->pwd = Hash::make($data['pwd']);
        $this->userModel->email = $data['email'];
        $this->userModel->phone = $data['phone'];
        $this->userModel->description = $data['description'] ?? null;
        $this->userModel->save();

        $this->userModel->address()->create([
            'town' => $data['town'],
            'street' => $data['street'] ?? null,
            'zipcode' => $data['zipcode'],
            'building_number' => $data['building_number'],
            'house_number' => $data['house_number'] ?? null
        ]);

        $this->userModel->personalDetails()->create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'] ?? null
        ]);

        return $this->userModel;
    }
}
