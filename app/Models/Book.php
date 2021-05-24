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

    /* ===> Methods <=== */
    public function hasCover(): bool
    {
        return (bool) $this->cover;
    }
}
