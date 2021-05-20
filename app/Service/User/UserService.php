<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private const FIELD_NAMES = ['uid', 'pwd', 'email', 'phone', 'avatar', 'description'];

    private User $userModel;
    private AddressService $address;
    private PersonalDataService $personalData;

    public function __construct(
        User $userModel,
        AddressService $address,
        PersonalDataService $personalData
    ) {
        $this->userModel = $userModel;
        $this->address = $address;
        $this->personalData = $personalData;
    }

    public function create(array $data): User
    {
        $data = $this->splitData($data);

        $accountFields = $data['account'];

        $this->userModel->uid = $accountFields['uid'];
        $this->userModel->pwd = Hash::make($accountFields['pwd']);
        $this->userModel->email = $accountFields['email'];
        $this->userModel->phone = $accountFields['phone'];
        $this->userModel->avatar = $accountFields['avatar'] ?? null;
        $this->userModel->description = $accountFields['description'] ?? null;
        $this->userModel->save();

        $this->userModel
            ->address()
            ->save($this->address->create($data['address']));

        $this->userModel
            ->address()
            ->save($this->personalData->create($data['personal']));

        return $this->userModel;
    }

    public function update(): void
    {
        # code...
    }

    public function acceptableFields(): array
    {
        return self::FIELD_NAMES;
    }

    private function splitData(array $data): array
    {
        return [
            'address' => array_intersect_key($data, array_flip($this->address->acceptableFields())),
            'personal' => array_intersect_key($data, array_flip($this->personalData->acceptableFields())),
            'account' => array_intersect_key($data, array_flip($this->acceptableFields()))
        ];
    }
}
