<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

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
}
