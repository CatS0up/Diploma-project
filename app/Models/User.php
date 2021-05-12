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

    public $timestamps = false;

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
        return $this->hasOne(PersonalDetail::class, 'user_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
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
        return $query
            ->with('role')
            ->whereIn('role_id', [2, 3]);
    }

    public function scopeNormal(Builder $query): Builder
    {
        return $query
            ->with('role')
            ->where('role_id', 1);
    }
}
