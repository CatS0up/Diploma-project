<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class VerifyCommentAuthor
{
    private AuthManager $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
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
        if ($this->auth->check() && $this->auth->id() != $request->input('user_id'))
            return redirect()
                ->route('book.show', $request->route('slug'))
                ->with('danger', 'Podczasz dodawania komentarza wystąpił błąd.');

        return $next($request);
    }
}
