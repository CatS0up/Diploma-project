<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'uid',
        'pwd',
        'email',
        'phone',
        'description'
    ];

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
        return $this->hasOne(PersonalDetail::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function roles()
    {
        return $this->hasOne(Role::class);
    }

    public function addAddress(Address $address): void
    {
        $this->address()->save($address);
    }

    public function addPersonalDetails(PersonalDetail $details): void
    {
        $this->personalDetails()->save($details);
    }


    /* ===> Scopes <=== */
    public function scopeUid(Builder $query, string $uid): Builder
    {
        return $query->where('uid', $uid)
            ->orWhere('email', $uid)
            ->orWhere('phone', $uid);
    }

    public function scopePrivilaged(Builder $query): Builder
    {
        return $query->whereIn('id', [2, 3]);
    }

    public function scopeNormal(Builder $query): Builder
    {
        return $query->where('id', 1);
    }
}
