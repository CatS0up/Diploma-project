<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use App\Services\Files\UserFilesService;

class UserService
{
    private User $user;
    private UserFilesService $file;

    public function __construct(User $user, UserFilesService $file)
    {
        $this->user = $user;
        $this->file = $file;
    }

    public function create(array $fields): User
    {
        $user = $this->user->create(
            [
                'uid'         => $fields['uid'],
                'pwd'         => $fields['pwd'],
                'email'       => $fields['email'],
                'phone'       => $fields['phone'],
                'description' => $fields['description'],
            ]
        );

        if (isset($fields['avatar']))
            $this->file->setOwner($user->id)->addAvatar($fields['avatar']);

        $user->address()->firstOrCreate(
            [
                'town'         => $fields['town'],
                'street'       => $fields['street'] ?? null,
                'zipcode'      => $fields['zipcode'],
                'local_number' => $fields['local_number'],
            ]
        )
            ->users()
            ->save($user);

        $user->personalDetails()->create(
            [
                'firstname' => $fields['firstname'],
                'lastname'  => $fields['lastname'],
                'birthday'  => $fields['birthday'],
                'gender'    => $fields['gender'] ?? null,
            ]
        );

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = $this->user->find($id);

        $this->file->setOwner($user->id)->deleteAvatar();

        return $user->delete();
    }


    public function update(int $id, array $fields): bool
    {

        $user = $this->user->find($id);

        $address = $user->address->firstOrCreate(
            [
                'town'         => $fields['town'],
                'street'       => $fields['street'] ?? null,
                'zipcode'      => $fields['zipcode'],
                'local_number' => $fields['local_number'],
            ]
        );

        $isUpdated = $user->update(
            [
                'address_id'  => $address->id,
                'uid'         => $fields['uid']         ?? $user->uid,
                'pwd'         => $fields['pwd']         ?? $user->pwd,
                'email'       => $fields['email']       ?? $user->email,
                'phone'       => $fields['phone']       ?? $user->phone,
                'description' => $fields['description'] ?? $user->description,
            ]
        );

        if (filter_var($fields['reset_avatar'], FILTER_VALIDATE_BOOLEAN)) {

            $this->file->setOwner($user->id)->deleteAvatar();
        } else {

            if (isset($fields['avatar']))
                $this->file->setOwner($user->id)->updateAvatar($fields['avatar']);
        }

        $user->personalDetails->update(
            [
                'firstname' => $fields['firstname'],
                'lastname'  => $fields['lastname'],
                'birthday'  => $fields['birthday'],
                'gender'    => $fields['gender'] ?? null,
            ]
        );

        return $isUpdated;
    }
}
