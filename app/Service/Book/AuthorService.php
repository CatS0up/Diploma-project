<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Author;

class AuthorService
{
    private const FIELD_NAMES = ['author'];

    private Author $authorModel;

    public function __construct(Author $authorModel)
    {
        $this->authorModel = $authorModel;
    }

    public function createSingle(array $data): Author
    {
        return $this->authorModel->firstOrCreate([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname']
        ]);
    }

    public function create(array $data): Author
    {
        $dataExploded = explode(' ', $data['author']);
        $this->authorModel->firstname = $dataExploded[0];
        $this->authorModel->lastname = $dataExploded[1];
        $this->authorModel->save();

        return $this->authorModel;
    }

    public function update(array $data): Author
    {
        $dataExploded = explode(' ', $data['author']);

        return $this->authorModel->firstOrCreate(
            [
                'firstname' => $dataExploded[0],
                'lastname' => $dataExploded[1]
            ]
        );
    }

    public function delete(int $id): bool
    {
        return $this->authorModel->find($id)->delete();
    }

    public function acceptableFields(): array
    {
        return self::FIELD_NAMES;
    }
}
