<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\Book;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserLibraryService
{
    private AuthManager $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function allPaginated(int $limit = 15): LengthAwarePaginator
    {
        return $this->auth->user()->books()->paginate($limit);
    }

    public function addBook(Book $book): void
    {
        $this->auth->user()->addBook($book);
    }

    public function removeBook(Book $book): void
    {
        $this->auth->user()->removeBook($book);
    }
}
