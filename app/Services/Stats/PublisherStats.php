<?php

declare(strict_types=1);

namespace App\Services\Stats;

use App\Models\Publisher;

class PublisherStats
{
    private Publisher $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public function coun(): int
    {
        return $this->publisher->count();
    }
}
