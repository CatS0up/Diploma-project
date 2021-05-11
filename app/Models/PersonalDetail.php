<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'firstname',
        'lastname',
        'birthday',
        'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
