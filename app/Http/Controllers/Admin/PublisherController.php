<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewPublisherRequest;
use App\Service\Book\ListingPublisherService;
use App\Service\Book\PublisherService;
use Illuminate\Http\RedirectResponse;

class PublisherController extends Controller
{
    private PublisherService $publisher;

    public function __construct(PublisherService $publisher)
    {
        $this->publisher = $publisher;
    }

    public function list(ListingPublisherService $publisherList)
    {
        return view('dashboard.publisherList', [
            'publishers' => $publisherList->allPaginated(),
            'stats' =>  $publisherList->stats()
        ]);
    }

    public function insert(NewPublisherRequest $request): RedirectResponse
    {
        $this->publisher->create($request->validated());

        return redirect()
            ->route('admin.get.publishers')
            ->with('success', 'Wydawca został pomyslnie dodany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->publisher->delete($id);

        return redirect()
            ->route('admin.get.publishers')
            ->with('success', 'Wydawca został usunięty pomyślnie.');
    }
}
