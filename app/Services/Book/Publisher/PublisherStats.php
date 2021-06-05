<?php

declare(strict_types=1);

namespace App\Services\Book\Publisher;

use App\Models\Publisher;

class PublisherStats
{
    private Publisher $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public function count(): int
    {
        return $this->publisher->count();
    }
}
