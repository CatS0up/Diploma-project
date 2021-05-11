<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'town',
        'street',
        'zipcode',
        'building_number',
        'house_number'
    ];

    public function users()
    {
        $this->belongsTo(User::class);
    }
}
