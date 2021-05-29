<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\User;
use App\Service\File\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private const FIELD_NAMES = [
        'uid', 'pwd', 'email', 'phone', 'avatar', 'description', 'reset_avatar'
    ];

    private User $userModel;
    private AddressService $address;
    private PersonalDataService $personalData;
    private FileService $file;

    public function __construct(
        User $userModel,
        AddressService $address,
        PersonalDataService $personalData,
        FileService $file
    ) {
        $this->userModel = $userModel;
        $this->address = $address;
        $this->personalData = $personalData;
        $this->file = $file;
    }

    public function findByUid(string $uid): User
    {
        return $this->userModel->firstWhere('uid', $uid);
    }

    public function findById(int $id): User
    {
        return $this->userModel->find($id);
    }

    public function create(array $data): User
    {
        $data = $this->splitData($data);

        $accountFields = $data['account'];

        $avatar = $accountFields['avatar'] ?? null;

        if ($avatar)
            $avatar = $this->file->save('avatars', $avatar);

        $this->userModel->uid = $accountFields['uid'];
        $this->userModel->pwd = $accountFields['pwd'];
        $this->userModel->email = $accountFields['email'];
        $this->userModel->phone = $accountFields['phone'];
        $this->userModel->avatar = $avatar;
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

    public function update(int $id, array $data): User
    {
        $data = $this->splitData($data);

        $accountFields = $data['account'];

        $this->userModel = $this->findById($id);

        $this->userModel->uid = $accountFields['uid']
            ?? $this->userModel->uid;
        $this->userModel->pwd = $this->updatePwd($accountFields['pwd'] ?? null);
        $this->userModel->email = $accountFields['email']
            ?? $this->userModel->email;
        $this->userModel->phone = $accountFields['phone']
            ?? $this->userModel->phone;
        $this->userModel->avatar = $this
            ->updateAvatar($accountFields['avatar'] ?? null, $accountFields['reset_avatar']);
        $this->userModel->description = $accountFields['description']
            ?? $this->userModel->description;

        $this->userModel->save();

        $this->userModel
            ->address()
            ->save(
                $this->address
                    ->update($this->userModel
                        ->address->id, $data['address'])
            );

        $this->userModel
            ->address()
            ->save(
                $this->personalData
                    ->update($this->userModel
                        ->personalDetails->id, $data['personal'])
            );

        return $this->userModel;
    }

    private function updatePwd(?string $pwd): ?string
    {
        return empty($pwd) ? $this->userModel->pwd : Hash::make($pwd);
    }

    private function updateAvatar(?UploadedFile $avatar, string $confirmation): ?string
    {
        if ($confirmation === 'yes' && $this->userModel->hasAvatar()) {
            $this->file->delete($this->userModel->avatar);
        } else if (isset($avatar) && $confirmation === 'no') {
            return $this->file->update($this->userModel->avatar, $avatar, 'avatars');
        }

        return null;
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
