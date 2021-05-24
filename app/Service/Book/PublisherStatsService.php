<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Publisher;

class PublisherStatsService
{
    private Publisher $publisherModel;

    public function __construct(Publisher $publisherModel)
    {
        $this->publisherModel = $publisherModel;
    }

    public function count(): int
    {
        return $this->publisherModel->count();
    }
}
