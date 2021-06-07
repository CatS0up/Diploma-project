<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReviewRequest;
use App\Services\Book\Review\ReviewService;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    private ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function add(AddReviewRequest $request, string $bookSlug): RedirectResponse
    {
        $data = $request->validated();

        $data['book_slug'] = $bookSlug;

        $this->reviewService->create($data);

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
