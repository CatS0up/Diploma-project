<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Publisher;
use Illuminate\Support\Collection;

class PublisherListing
{
    private Publisher $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public function all(): Collection
    {
        return $this->publisher->all();
    }
}
