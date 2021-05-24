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

    /* ===> Accessors <=== */
    public function getFullNameAttribute(): string
    {
        return "{$this->firstname} {$this->lastname}";
    }

    /* ===> Mutatros <=== */
    public function setFirstnameAttribute(string $firstname): void
    {
        $this->attributes['firstname'] = ucfirst($firstname);
    }

    public function setLastnameAttribute(string $lastname): void
    {
        $this->attributes['lastname'] = str_contains($lastname, '-') ?
            preg_replace('/([^A-Z])\-([^A-Z])/', "$1-$2", $lastname) : ucfirst($lastname);
    }
}
