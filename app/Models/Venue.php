<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use softDeletes;
    protected $fillable = [
        'name',
        'description',
        'available',
    ];


}
