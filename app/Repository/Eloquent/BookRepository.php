<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Book;
use App\Repository\BookRepository as BookRepositoryInterface;
use App\Repository\Filterable;
use App\Repository\Maintable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class BookRepository implements BookRepositoryInterface, Maintable, Filterable
{
    private Book $bookModel;

    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function create(array $data): Book
    {
        $this->bookModel->publisher_id = $data['publisher'];
        $this->bookModel->title = $data['title'];
        $this->bookModel->isbn = $data['isbn'];
        $this->bookModel->file = $data['pdf'];
        $this->bookModel->description = $data['description'];
        $this->bookModel->publishing_date = $data['publishing_date'];
        $this->bookModel->cover = $data['cover'] ?? null;
        $this->bookModel->save();

        $this->bookModel->genres()->firstOrCreate(
            ['name' => $data['genres']]
        );

        $authorExploded = explode(' ', $data['authors']);
        $this->bookModel->authors()->firstOrCreate(
            [
                'firstname' => $authorExploded[0],
                'lastname' => $authorExploded[1]

            ]
        );

        return $this->bookModel;
    }


    public function get(int $id): ?Book
    {
        return $this->bookModel->find($id);
    }

    public function update(array $data)
    {
    }

    public function delete(int $id): bool
    {
        $book = $this->bookModel->find($id);
        $book->authors()->detach();
        $book->genres()->detach();
        $book->delete();

        return true;
    }

    public function all(): Collection
    {
        return $this->bookModel
            ->with(self::RELATIONS)
            ->get();
    }

    public function allPaginated(int $limit = self::LIMIT): Paginator
    {
        return $this->bookModel->paginate($limit);
    }

    public function filterBy(array $filters, int $limit = self::LIMIT)
    {
        $query = $this->bookModel
            ->with(self::RELATIONS);

        if ($filters['q']) {
            $phrase = "{$filters['q']}%";

            $query->where('title', 'like', $phrase)
                ->orWhere('isbn', 'like', $phrase)
                ->orWhereHas(
                    'authors',
                    fn (Builder $q) => $q->where('firstname', 'like', $phrase)
                        ->orWhere('lastname', 'like', $phrase)
                );
        }

        if ($filters['publisher'] !== self::PUBLISHER_ALL) {
            $query->whereHas('publisher', fn (Builder $q) => $q->where('name', $filters['publisher']));
        }

        if ($filters['genre'] !== self::GENRE_ALL) {
            $query->whereHas('genres', fn (Builder $q) => $q->where('name', $filters['genre']));
        }

        if ($sort = $filters['sort']) {
            $sort = in_array($sort, ['asc', 'desc']) ? $sort : self::SORT_DEFAULT;

            $query->orderBy('title', $sort);
        }

        return $query->paginate($limit);
    }

    public function stats(): array
    {
        return [
            'count' => $this->bookModel->count()
        ];
    }
}
