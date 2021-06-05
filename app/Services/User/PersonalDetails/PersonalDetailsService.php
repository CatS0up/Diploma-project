<?php

declare(strict_types=1);

namespace App\Services\User\PersonalDetails;

use App\Models\PersonalDetail;

class PersonalDetailsService
{
    private PersonalDetail $personalDetails;

    public function __construct(PersonalDetail $personalDetails)
    {
        $this->personalDetails = $personalDetails;
    }

    public function create(array $fields): PersonalDetail
    {
        return $this->personalDetails->create(
            [
                'firstname' => $fields['firstname'],
                'lastname' =>  $fields['lastname'],
                'birthday' => $fields['birthday'],
                'gender' => $fields['gender'] ?? null,
            ]
        );
    }
}
