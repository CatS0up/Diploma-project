<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'town',
        'street',
        'zipcode',
        'building_number',
        'house_number'
    ];

    public function users()
    {
        $this->hasMany(User::class);
    }
}
