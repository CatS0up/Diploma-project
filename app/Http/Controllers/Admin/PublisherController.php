<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewPublisherRequest;
use App\Models\Publisher;
use App\Services\Book\Publisher\PublisherCatalog;
use Illuminate\Http\RedirectResponse;

class PublisherController extends Controller
{
    private Publisher $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public function list(PublisherCatalog $publisherList)
    {
        return view('dashboard.publisher.list', [
            'publishers' => $publisherList->allPaginated(),
            'stats' =>  $publisherList->stats()
        ]);
    }

    public function insert(NewPublisherRequest $request): RedirectResponse
    {
        $this->publisher->fill($request->validated());

        return redirect()
            ->route('admin.get.publishers')
            ->with('success', 'Wydawca został pomyslnie dodany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->publisher->find($id)->delete();

        return redirect()
            ->route('admin.get.publishers')
            ->with('success', 'Wydawca został usunięty pomyślnie.');
    }
}
