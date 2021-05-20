<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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


    /* ===> Relations <=== */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'userBooks');
    }

    public function personalDetails()
    {
        return $this->hasOne(PersonalDetail::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
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
            ->whereIn('role_id', [2, 3]);
    }

    public function scopeNormal(Builder $query): Builder
    {
        return $query
            ->where('role_id', 1);
    }

    /* ===> Methods <=== */
    public function clearData(): void
    {
        $this->personalDetails()->$this->delete();
    }

    public function addBook(Book $book): void
    {
        $this->books()->save($book);
    }

    public function bookAmount(): int
    {
        return $this->books()->count();
    }

    public function removeBook(Book $book): void
    {
        $this->books()->detach($book);
    }

    public function isSuperadmin(): bool
    {
        return (int) $this->role_id === 3;
    }

    public function isAdmin(): bool
    {
        return in_array((int) $this->role_id, [2, 3]);
    }

    public function hasBook(int $bookId): bool
    {
        return (bool) $this->books()->where('userBooks.book_id', $bookId)->first();
    }
}
