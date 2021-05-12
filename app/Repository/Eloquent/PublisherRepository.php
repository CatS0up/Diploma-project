<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Publisher;
use App\Repository\PublisherRepository as PublisherRepositoryInterface;
use Illuminate\Support\Collection;

class PublisherRepository implements PublisherRepositoryInterface
{
    private Publisher $publisherModel;

    public function __construct(Publisher $publisherModel)
    {
        $this->publisherModel = $publisherModel;
    }
    public function all(): Collection
    {
        return $this->publisherModel->get();
    }
}
