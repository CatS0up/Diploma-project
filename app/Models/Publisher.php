<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    /* ===> Relations <=== */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /* ===> Mutators <=== */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = ucwords($name);
    }
}
