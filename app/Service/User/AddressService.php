<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\Address;

class AddressService
{
    private const FIELD_NAMES = ['town', 'street', 'zipcode', 'house_number'];

    private Address $addressModel;

    public function __construct(Address $addressModel)
    {
        $this->addressModel = $addressModel;
    }

    final public function create(array $data): Address
    {
        $this->addressModel->town = $data['town'];
        $this->addressModel->street = $data['street'] ?? null;
        $this->addressModel->zipcode = $data['zipcode'];
        $this->addressModel->house_number = $data['house_number'];
        $this->addressModel->save();

        return $this->addressModel;
    }

    final public function update(int $id, array $data): Address
    {
        $this->addressModel = $this->addressModel->find($id);

        $this->addressModel->town = $data['town']
            ?? $this->addressModel->town;
        $this->addressModel->street = $data['street']
            ?? $this->addressModel->street;
        $this->addressModel->zipcode = $data['zipcode']
            ?? $this->addressModel->zipcode;
        $this->addressModel->house_number = $data['house_number']
            ??  $this->addressModel->house_number;

        $this->addressModel->save();

        return $this->addressModel;
    }

    public function acceptableFields(): array
    {
        return self::FIELD_NAMES;
    }
}
