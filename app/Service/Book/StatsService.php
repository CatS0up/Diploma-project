<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Book;
use App\Models\Review;

class StatsService
{
    private Book $bookModel;

    public function __construct(Book $bookModel, Review $reviewModel)
    {
        $this->bookModel = $bookModel;
        $this->reviewModel = $reviewModel;
    }

    public function countStats(): array
    {
        return [
            'all_amount' => $this->allCount(),
            'best_amount' => $this->bestAmount()
        ];
    }

    public function allCount(): int
    {
        return $this->bookModel->count();
    }

    public function bestAmount(): int
    {
        return 100;
    }
}
