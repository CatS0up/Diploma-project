<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Publisher;
use App\Repositories\PublisherRepository as PublisherRepositoryInterface;
use Illuminate\Support\Collection;

class PublisherRepository implements PublisherRepositoryInterface
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
