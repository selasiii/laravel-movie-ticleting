<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'genre', 'poster'
    ];

    public function showings()
    {
        return $this->hasMany(Showtime::class);
    }

    public function activeShowings()
    {
        return $this->showings()->where('showing_datetime', '>', now());
    }

    // Using an accessor for the poster URL
    public function getPosterUrlAttribute()
    {
        if (Str::contains($this->poster, "https")) {
            return $this->poster;
        } else {
            // Make sure you've set up the 'images' disk in filesystems.php
            return Storage::disk('images')->url($this->poster);
        }
    }
}
