<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Ticket extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id'; // Explicitly setting the primary key field name
    public $incrementing = false; // Indicate that the IDs aren't auto-incrementing
    protected $keyType = 'string'; // Set the data type of the primary key

    protected $fillable = [
        'user_id', 'showtime_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function showtime() 
    {
        return $this->belongsTo(Showtime::class);
    }
}
