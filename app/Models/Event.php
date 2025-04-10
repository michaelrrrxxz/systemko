<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'venue_id',
        'user_id',
        'start_time',
        'end_time',
    ];

    protected $dates = [
        'start_time',
        'end_time',
        'deleted_at',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function scopeFinished($query)
    {
        return $query->where('end_time', '<', Carbon::now());
    }

    public function scopeOngoing($query)
    {
        $now = Carbon::now();
        return $query->where('start_time', '<=', $now)
                    ->where('end_time', '>=', $now);
    }

    public function scopeFuture($query)
    {
        return $query->where('start_time', '>', Carbon::now());
    }

}
