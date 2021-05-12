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

    public function get(int $id): ?User
    {
        return $this->userModel->find($id);
    }

    public function update(array $data)
    {
        $model = $this->userModel->find($data['id']);
        $model->role_id = $data['role'];
        $model->uid = $data['uid'];
        $model->email = $data['email'];
        $model->phone = $data['phone'];
        $model->description = $data['description'] ?? null;
        $model->save();

        $model->address()->update([
            'town' => $data['town'],
            'street' => $data['street'] ?? null,
            'zipcode' => $data['zipcode'],
            'building_number' => $data['building_number'],
            'house_number' => $data['house_number'] ?? null
        ]);

        $model->personalDetails()->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'] ?? null
        ]);
    }

    public function delete(int $id): bool
    {
        $user = $this->userModel->find($id);

        $user->address()->delete();
        $user->personalDetails()->delete();
        $user->delete();

        return empty($user);
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

    public function stats(): array
    {
        return [
            'count' => $this->userModel->count(),
            'privilagedCount' => $this->userModel->privilaged()->count()
        ];
    }
}
