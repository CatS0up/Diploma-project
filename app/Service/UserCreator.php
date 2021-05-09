<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Address;
use App\Models\PersonalDetail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreator
{
    private const ADDRESS_INPUTS = [
        'town',
        'street',
        'zipcode',
        'building_number',
        'house_number'
    ];

    private const DETAILS_INPUTS = [
        'firstname',
        'lastname',
        'birthday',
        'gender'
    ];

    private User $user;
    private Address $address;
    private PersonalDetail $details;

    public function __construct(
        User $user,
        Address $address,
        PersonalDetail $details
    ) {
        $this->user = $user;
        $this->address = $address;
        $this->details = $details;
    }

    public function create(array $data)
    {
        $this->user->uid = $data['uid'];
        $this->user->pwd = Hash::make($data['pwd']);
        $this->user->email = $data['email'];
        $this->user->phone = $data['phone'];
        $this->user->description = $data['description'] ?? null;
        $this->user->save();

        $this->createAddress(array_intersect_key($data, array_flip(self::ADDRESS_INPUTS)));
        $this->createPersonalDetails(array_intersect_key($data, array_flip(self::DETAILS_INPUTS)));

        $this->user->addAddress($this->address);
        $this->user->addPersonalDetails($this->details);
    }

    private function createAddress(array $data)
    {
        $this->address->town = $data['town'];
        $this->address->street = $data['street'] ?? null;
        $this->address->zipcode = $data['zipcode'];
        $this->address->building_number = $data['building_number'] ?? null;
        $this->address->house_number = $data['house_number'];
        $this->address->save();
    }

    private function createPersonalDetails(array $data)
    {
        $this->details->firstname = $data['firstname'];
        $this->details->lastname = $data['lastname'];
        $this->details->birthday = $data['birthday'];
        $this->details->gender = $data['gender'] ?? null;
        $this->details->save();
    }
}
