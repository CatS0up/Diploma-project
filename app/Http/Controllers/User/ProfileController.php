<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show(string $uid): View
    {
        return view(
            'me.profile',
            ['user' => $this->user->firstWhere('uid', $uid)]
        );
    }

    public function destroy(string $uid): RedirectResponse
    {
        $this->user->delete($this->user->findByUid($uid)->id);

        return redirect()
            ->route('home')
            ->with('success', 'Konto zostało usunięte.');
    }
}
