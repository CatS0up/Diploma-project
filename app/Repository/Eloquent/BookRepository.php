<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Book;
use App\Repository\BookRepository as BookRepositoryInterface;
use Illuminate\Support\Collection;

class BookRepository implements BookRepositoryInterface
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
        return true;
    }

    public function all(): Collection
    {
        return $this->bookModel->get();
    }
}
