<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Book;

class BookService
{
    private const FIELD_NAMES = [
        'publisher', 'title', 'isbn', 'pdf', 'avatar', 'description', 'publishing_date',
        'cover', 'reset_cover'
    ];

    private Book $bookModel;

    public function create(array $data): Book
    {
        $this->bookModel->publisher_id = $data['publisher'];
        $this->bookModel->title = $data['title'];
        $this->bookModel->isbn = $data['isbn'];
        $this->bookModel->file = $data['pdf'];
        $this->bookModel->description = $data['description'];
        $this->bookModel->publishing_date = $data['publishing_date'];
        $this->bookModel->cover = $data['cover'] ?? null;
        $this->bookModel->save();

        return $this->bookModel;
    }

    public function acceptableFields(): array
    {
        return self::FIELD_NAMES;
    }

    private function splitData(array $data): array
    {
        return [
            'address' => array_intersect_key($data, array_flip($this->address->acceptableFields())),
            'personal' => array_intersect_key($data, array_flip($this->personalData->acceptableFields())),
            'account' => array_intersect_key($data, array_flip($this->acceptableFields()))
        ];
    }
}
