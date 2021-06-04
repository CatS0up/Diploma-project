<?php

declare(strict_types=1);

namespace App\Services\User\Address;

use App\Models\Address;

class AddressService
{
    private Address $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function create(array $fields): Address
    {
        return $this->address->firstOrCreate(
            [
                'town' => $fields['town'],
                'street' =>  $fields['street'] ?? null,
                'zipcode' => $fields['zipcode'],
                'local_number' => $fields['local_number'],
            ]
        );
    }

    public function delete(int $id): bool
    {
        if ($this->hasUsers())
            return true;

        $this->address->find($id)->delete();

        return $this->isExist($id);
    }

    private function hasUsers(): bool
    {
        return $this->address->has('users')->exists();
    }

    private function isExist(int $id): bool
    {
        return  $this->address->find($id)->exists();
    }
}
