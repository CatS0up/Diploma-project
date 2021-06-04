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
                'house_number' => $fields['house_number'],
            ]
        );
    }
}
