<?php

declare(strict_types=1);

namespace App\Services\Account;

use App\Models\User;
use App\Service\User\PersonalDataService;
use App\Services\User\Address\AddressService;
use App\Services\User\UserService;

class AccountCreator
{
    private const EXPECTED_FIELDS =
    [
        'account' => [
            'uid', 'email', 'phone',
            'pwd', 'avatar', 'description'
        ],

        'address' =>
        [
            'town', 'zipcode', 'street',
            'local_number',
        ],

        'personal_info' => [
            'firstname', 'lastname', 'birthday',
            'gender'
        ]
    ];

    private UserService $user;
    private AddressService $address;
    private PersonalDataService $personalInfo;

    public function __construct(
        UserService $user,
        AddressService $address,
        PersonalDataService $personalInfo
    ) {
        $this->user = $user;
        $this->address = $address;
        $this->personalInfo = $personalInfo;
    }

    public function create(array $fields): User
    {
        $fields = $this->groupFields($fields);

        $user = $this->user->create($fields['account']);

        $user
            ->address()
            ->associate($this->address->create($fields['address']));

        $user
            ->personalDetails()
            ->save($this->personalInfo->create($fields['personal_info']));

        return $user;
    }

    private function groupFields(array $fields): array
    {
        return [
            'account' => $this->extractFields($fields, self::EXPECTED_FIELDS['account']),
            'address' => $this->extractFields($fields, self::EXPECTED_FIELDS['address']),
            'personal_info' => $this->extractFields($fields, self::EXPECTED_FIELDS['personal_info'])
        ];
    }

    private function extractFields(array $fields, array $exceptedFields): array
    {
        return array_intersect_key($fields, array_flip($exceptedFields));
    }
}
