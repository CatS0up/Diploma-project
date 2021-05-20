<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Review;

class ReviewService
{
    private Review $reviewModel;

    public function __construct(Review $reviewModel)
    {
        $this->reviewModel = $reviewModel;
    }

    public function create(array $data): bool
    {
        $this->reviewModel->user_id = $data['user_id'];
        $this->reviewModel->book_id = $data['book_id'];
        $this->reviewModel->title = $data['title'];
        $this->reviewModel->rate = $data['rate'];
        $this->reviewModel->text_content = $data['review'];
        $this->reviewModel->save();

        return (bool) $this->reviewModel->id;
    }
}
