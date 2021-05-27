<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Publisher;

class PublisherService
{
    private const FIELD_NAMES = ['publisher'];

    private Publisher $publisherModel;

    public function __construct(Publisher $publisherModel)
    {
        $this->publisherModel = $publisherModel;
    }

    public function createSingle(array $data): Publisher
    {
        $this->publisherModel->firstOrCreate(['name' => $data['name']]);

        return $this->publisherModel;
    }

    public function delete(int $id): bool
    {
        return $this->publisherModel->find($id)->delete();
    }

    public function acceptableFields(): array
    {
        return self::FIELD_NAMES;
    }
}
