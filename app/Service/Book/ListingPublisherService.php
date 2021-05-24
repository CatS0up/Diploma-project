<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Publisher;
use Illuminate\Support\Collection;

class ListingPublisherService
{
    private Publisher $publisherModel;

    public function __construct(Publisher $publisherModel)
    {
        $this->publisherModel = $publisherModel;
    }

    public function all(): Collection
    {
        return $this->publisherModel->all();
    }
}
