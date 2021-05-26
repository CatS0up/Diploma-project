<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /* ===> Relations <=== */
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'BookAuthors');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'BookGenres');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /* ===> Mutators <=== */
    public function setTitleAttribute(string $title): void
    {
        $this->attributes['title'] = ucwords($title);
    }

    /* ===> Methods <=== */
    public function hasCover(): bool
    {
        return (bool) $this->cover;
    }

    public function rateAvg(): float
    {
        return (float) $this->reviews()->avg('rate');
    }

    public function countRates(): int
    {
        return $this->reviews->count();
    }
}
