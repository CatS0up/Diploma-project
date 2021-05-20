<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReviewRequest;
use App\Service\ReviewService;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    private ReviewService $review;

    public function __construct(ReviewService $review)
    {
        $this->review = $review;
    }

    public function add(AddReviewRequest $request, AuthManager $auth): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $auth->id();

        $this->review->create($data);

        return redirect()
            ->route('book.show', ['id' => $data['book_id']])
            ->with('success', 'Recenzja została dodana.');
    }

    public function remove(int $id, int $bookId): RedirectResponse
    {
        return redirect()
            ->route('book.show', ['id' => $bookId])
            ->with('success', 'Recenzja została dodana.');
    }
}
