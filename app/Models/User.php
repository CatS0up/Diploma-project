<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ===> Relations <=== */
    public function personalDetails()
    {
        $this->hasOne(PersonalDetail::class);
    }

    public function address()
    {
        $this->hasOne(Address::class);
    }

    public function roles(): void
    {
        $this->hasOne(Role::class);
    }

    public function create(array $data)
    {
        $this->create(
            [
                'uid' => $data['uid'],
                'pwd' => Hash::make($data['pwd']),
                'phone' => $data['phone'],
                'description' => $data['description']
            ]
        );
    }
}
