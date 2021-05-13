<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'firstname',
        'lastname',
    ];

    /* ===> Relations <=== */
    public function books()
    {
        return $this->belongsToMany('books', 'BookAuthors');
    }
}