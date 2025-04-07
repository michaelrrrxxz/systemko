<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'description',
        'available',
    ];

    // Define any relationships or methods if needed
}
