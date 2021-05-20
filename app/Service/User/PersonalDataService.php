<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\PersonalDetail;

class PersonalDataService
{
    private const FIELD_NAMES = ['firstname', 'lastname', 'birthday', 'gender'];

    private PersonalDetail $personalDetailsModel;

    public function __construct(PersonalDetail $personalDetailsModel)
    {
        $this->personalDetailsModel = $personalDetailsModel;
    }

    final public function create(array $data): PersonalDetail
    {
        $this->personalDetailsModel->firstname = $data['firstname'];
        $this->personalDetailsModel->lastname = $data['lastname'];
        $this->personalDetailsModel->birthday = $data['birthday'];
        $this->personalDetailsModel->gender = $data['gender'] ?? null;
        $this->personalDetailsModel->save();

        return $this->personalDetailsModel;
    }

    public function acceptableFields(): array
    {
        return self::FIELD_NAMES;
    }
}
