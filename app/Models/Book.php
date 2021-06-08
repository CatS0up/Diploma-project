<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'publisher_id',
        'title',
        'slug',
        'isbn',
        'pages',
        'description',
        'cover',
        'file'
    ];

    /* ===> Relations <=== */
    public function users()
    {
        return $this->belongsToMany(User::class, 'UserBooks');
    }

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

    public function setSlugAttribute(string $title): void
    {
        $this->attributes['slug'] = Str::slug($title . '-' . $this->publisher->name);
    }

    /* ===> Accessors <=== */
    public function getRateAvgAttribute(): float
    {
        return round($this->reviews()->avg('rate'), 2);
    }

    /* ===> Methods <=== */
    public function hasCover(): bool
    {
        return (bool) $this->cover;
    }

    public function hasFile(): bool
    {
        return (bool) $this->file;
    }

    public function rateAvg(): float
    {
        return (float) $this->reviews()->avg('rate');
    }

    public function countRates(): int
    {
        return $this->reviews->count();
    }

    public function countReviews(): int
    {
        return $this->reviews->count();
    }
}
