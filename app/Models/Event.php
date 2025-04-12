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
        'added_by',
        'start_time',
        'end_time',
        'approved_by', // Corrected spelling of 'approved_by'
        'approved_at', // Added 'is_approved' field
    ];

    protected $dates = [
        'start_time',
        'end_time',
        'deleted_at',
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by'); // Relationship for the admin who approved the event
    }

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
