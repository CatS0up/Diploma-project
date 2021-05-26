<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Book;
use App\Service\File\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class BookService
{
    private const FIELD_NAMES = [
        'publisher', 'title', 'isbn', 'pdf', 'avatar', 'description', 'publishing_date',
        'cover', 'reset_cover'
    ];

    private Book $bookModel;
    private GenreService $genre;
    private AuthorService $author;
    private FileService $file;

    public function __construct(
        Book $bookModel,
        GenreService $genre,
        AuthorService $author,
        FileService $file
    ) {
        $this->bookModel = $bookModel;
        $this->genre = $genre;
        $this->author = $author;
        $this->file = $file;
    }

    public function findById(int $id): Book
    {
        return $this->bookModel->find($id);
    }

    public function findBySlug(string $slug): Book
    {
        return $this->bookModel->firstWhere('slug', $slug);
    }

    public function create(array $data): Book
    {
        $data = $this->splitData($data);

        $bookFields = $data['book'];

        if (isset($bookFields['pdf']))
            $bookFields['pdf'] = $this->file->disk('local')->save('pdfs', $bookFields['pdf']);


        if (isset($bookFields['cover']))
            $bookFields['cover'] = $this->file->disk('public')->save('covers', $bookFields['cover']);

        $this->bookModel->publisher_id = $bookFields['publisher'];
        $this->bookModel->slug = Str::slug($bookFields['title']);
        $this->bookModel->title = $bookFields['title'];
        $this->bookModel->isbn = $bookFields['isbn'];
        $this->bookModel->file = $bookFields['pdf'];
        $this->bookModel->description = $bookFields['description'];
        $this->bookModel->publishing_date = $bookFields['publishing_date'];
        $this->bookModel->cover = $bookFields['cover'] ?? null;
        $this->bookModel->save();

        $this->bookModel
            ->genres()
            ->saveMany($this->genre->createMany($data['genres']));

        $this->bookModel
            ->authors()
            ->saveMany($this->author->createMany($data['authors']));

        return $this->bookModel;
    }

    public function update(int $id, array $data): Book
    {
        $data = $this->splitData($data);

        $bookFields = $data['book'];

        $this->bookModel = $this->findById($id);

        $this->bookModel->title = $bookFields['title'] ?? $this->bookModel->title;
        $this->bookModel->isbn = $bookFields['isbn'] ?? $this->bookModel->isbn;
        $this->bookModel->file = $this->updatePdf($bookFields['pdf'] ?? null);
        $this->bookModel->description = $bookFields['description']
            ?? $this->bookModel->description;
        $this->bookModel->publishing_date = $bookFields['publishing_date']
            ?? $this->bookModel->publishing_date;
        $this->bookModel->cover =
            $this->updateCover($bookFields['cover'] ?? null, $bookFields['reset_cover']);
        $this->bookModel->save();

        $this->bookModel
            ->genres()
            ->saveMany($this->genre->createMany($data['genres']));

        $this->bookModel
            ->authors()
            ->saveMany($this->author->createMany($data['authors']));

        return $this->bookModel;
    }

    public function delete(int $id): bool
    {
        $book = $this->bookModel->find($id);

        if ($book->hasCover())
            $this->file->delete($book->cover);

        $this->file->disk('local')->delete($book->file);

        $book->delete();

        return (bool) $this->bookModel->find($id);
    }

    public function acceptableFields(): array
    {
        return self::FIELD_NAMES;
    }

    private function updateCover(?UploadedFile $cover, string $confirmation): ?string
    {
        if ($confirmation === 'yes' && $this->bookModel->hasCover()) {
            $this->file->delete($this->bookModel->cover);
        } else if (isset($cover) && $confirmation === 'no') {
            return $this->file->update($this->bookModel->cover, $cover, 'covers');
        }

        return null;
    }

    private function updatePdf(?UploadedFile $pdf): string
    {
        if (isset($pdf)) {
            return $this->file->disk('local')->update($this->bookModel->file, $pdf, 'pdfs');
        }

        return $this->bookModel->file;
    }

    private function splitData(array $data): array
    {
        return [
            'genres' => array_intersect_key($data, array_flip($this->genre->acceptableFields())),
            'authors' => array_intersect_key($data, array_flip($this->author->acceptableFields())),
            'book' => array_intersect_key($data, array_flip($this->acceptableFields()))
        ];
    }
}
