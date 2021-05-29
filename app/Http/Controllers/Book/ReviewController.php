<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReviewRequest;
use App\Service\ReviewService;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    private ReviewService $review;

    public function __construct(ReviewService $review)
    {
        $this->review = $review;
    }

    public function add(AddReviewRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->review->create($data);

        return redirect()
            ->back()
            ->with('success', 'Recenzja została dodana.');
    }

    public function destroy(int $bookId): RedirectResponse
    {
        $this->review->delete($bookId);

        return redirect()
            ->route('book.show', ['id' => $bookId])
            ->with('success', 'Recenzja została dodana.');
    }
}
