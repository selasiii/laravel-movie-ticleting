<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Showtime extends Model
{
    use HasFactory;

    protected $dates = ['showing_datetime']; // Cast showing_datetime as a Carbon instance

    public $timestamps = false;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Using accessors for formatted date and time
    public function getFormattedDateAttribute()
    {
        return $this->showing_datetime->toFormattedDateString();
    }

    public function getFormattedTimeAttribute()
    {
        return $this->showing_datetime->format('h A');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('showing_datetime', '>', now());
    }

    // Optimizing by querying instead of loading all and filtering
    public function otherShowtimes()
    {
        return $this->movie->showtimes()
            ->active()
            ->where('id', '<>', $this->id)
            ->get();
    }

    public function getTicketsPurchasedAttribute()
    {
        return $this->tickets()->count();
    }

    public function getTicketsAvailableAttribute()
    {
        return $this->limit - $this->tickets_purchased;
    }

    public function getIsSoldOutAttribute()
    {
        return $this->tickets_purchased >= $this->limit;
    }
}
