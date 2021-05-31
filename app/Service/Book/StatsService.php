<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

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
        $subquery = DB::table('reviews')
            ->selectRaw(DB::raw('AVG(rate) as avg_rate'))
            ->groupBy('reviews.book_id')
            ->havingRaw('avg_rate >= 4');

        $count = DB::table(DB::raw("({$subquery->toSql()}) as bestTable"))
            ->count();

        return $count;
    }
}
