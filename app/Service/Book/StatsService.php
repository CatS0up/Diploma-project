<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

class StatsService
{
    private Book $bookModel;

    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
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
        return (int) DB::table('reviews')
            ->avg('rate');
    }
}
