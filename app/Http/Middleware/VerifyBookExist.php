<?php

namespace App\Http\Middleware;

use App\Models\Book;
use Closure;
use Illuminate\Http\Request;

class VerifyBookExist
{
    private Book $bookModel;

    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->bookModel->find($request->route('id')))
            abort('404');

        return $next($request);
    }
}
