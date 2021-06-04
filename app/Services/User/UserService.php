<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use App\Services\Files\FilesManager;
use Illuminate\Http\UploadedFile;

class UserService
{
    private User $user;
    private FilesManager $avatarFile;

    public function __construct(User $user, FilesManager $avatarFile)
    {
        $this->user = $user;
        $this->avatarFile = $avatarFile;
    }

    public function create(array $fields): User
    {
        return $this->user->create(
            [
                'address_id' => $fields['address_id'],
                'uid' => $fields['uid'],
                'pwd' => $fields['pwd'],
                'email' => $fields['email'],
                'phone' => $fields['phone'],
                'avatar' => $this
                    ->avatarFile
                    ->save($fields['avatar'] ?? null, 'public/avatars'),
                'description' => $fields['description'],
            ]
        );
    }

    public function update(int $userId, array $fields): bool
    {
        $this->user = $this->user->find($userId);

        return $this->user->update(
            [
                'uid' => $fields['uid'],
                'pwd' => $fields['pwd'],
                'email' => $fields['email'],
                'phone' => $fields['phone'],
                'avatar' => $this->changeAvatar(
                    $fields['reset_avatar'],
                    $fields['avatar'] ?? null
                ),
                'description' => $fields['description'],
            ]
        );
    }

    public function delete(int $id): bool
    {
        if ($this->user->hasAvatar())
            $this->avatarFile->delete('public/' . $this->user->avatar);

        $this->user->find($id)->delete();

        return !$this->user->find($id)->exists();
    }

    public function changeAvatar(?UploadedFile $avatar, ?bool $reset = false): ?string
    {
        return match (true) {
            $reset => $this->avatar->reset(),
            !$reset => $this->avatar->update(
                $this->user->avatar,
                $avatar
            ),
        };
    }
}
