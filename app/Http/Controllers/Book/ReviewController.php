<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReviewRequest;
use App\Models\Review;

use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    private Review $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function add(AddReviewRequest $request, string $bookSlug): RedirectResponse
    {
        $data = $request->validated();

        $data['book_id'] = $bookId;

        $this->review->create($data);

        return back()
            ->with('success', 'Recenzja została dodana.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->review->delete($id);

        return back()
            ->with('success', 'Recenzja została usunięta.');
    }
}
