<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];

    /* ===> Relations <=== */
    public function books()
    {
        return $this->belongsToMany('books', 'BookGenres');
    }

    /* ===> Mutators <=== */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = ucwords($name);
    }
}
