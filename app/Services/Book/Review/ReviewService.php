<?php

declare(strict_types=1);

namespace App\Services\Book\Review;

use App\Models\Book;
use App\Models\Review;

class ReviewService
{
    private Book $book;
    private Review $review;

    public function __construct(Book $book, Review $review)
    {
        $this->book = $book;
        $this->review = $review;
    }

    public function create(array $fields): Review
    {
        $bookId = $this->book->firstWhere('slug', $fields['book_slug'])->id;

        return $this->review->create(
            [
                'book_id'      => $bookId,
                'user_id'      => $fields['user_id'],
                'rate'         => $fields['rate'],
                'text_content' => $fields['comment']
            ]
        );
    }

    public function delete(int $id): bool
    {
        return $this->review->find($id)->delete();
    }
}
