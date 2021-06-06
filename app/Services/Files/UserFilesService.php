<?php

declare(strict_types=1);

namespace App\Services\Files;

use App\Models\User;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;

class UserFilesService
{
    private FilesystemManager $file;

    private User $owner;

    private bool $ownerIsAssigned = false;

    public function __construct(FilesystemManager $file, User $owner)
    {
        $this->file = $file;
        $this->owner = $owner;
    }

    public function setOwner(int $id): UserFilesService
    {
        $this->owner = $this->owner->find($id);

        $this->ownerIsAssigned = !$this->ownerIsAssigned;

        return $this;
    }

    public function addAvatar(UploadedFile $avatar): bool
    {
        if (!$this->ownerIsAssigned())
            return false;

        $this->owner->update(['avatar' => $this->file
            ->disk('public')
            ->put('avatars', $avatar)]);

        return $this->owner->hasAvatar();
    }

    public function updateAvatar(UploadedFile $avatar): bool
    {
        if (!$this->ownerIsAssigned())
            return false;

        $this->deleteAvatar();

        return $this->addAvatar($avatar);
    }

    public function deleteAvatar(): bool
    {
        if (!$this->ownerIsAssigned())
            return false;

        $isDeleted = false;

        if ($this->owner->hasAvatar())
            $isDeleted = $this->file->delete($this->owner->avatar);

        $this->owner->update(['avatar' => null]);

        return $isDeleted && !$this->owner->hasAvatar();
    }

    private function ownerIsAssigned(): bool
    {
        return $this->ownerIsAssigned;
    }
}
