<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Author;
use Illuminate\Support\Collection;

class AuthorService
{
    private const FIELD_NAMES = ['authors'];

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

    public function createMany(array $data): Collection
    {
        $authors = preg_split('/ ?[,]{1} ?/', $data['authors']);
        $authors = array_unique($authors);

        $authorModels = [];
        foreach ($authors as $author) {
            /**
             * $authosComponents[0] - Firstname
             * $authosComponents[1] - Lastname
             */
            $authorComponents = explode(' ', $author);

            $authorModels[] =  $this->authorModel->firstOrCreate(
                [
                    'firstname' =>  $authorComponents[0],
                    'lastname' =>  $authorComponents[1]
                ]
            );
        }

        return collect(array_unique($authorModels));
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
