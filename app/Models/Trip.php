<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'destination',
        'description',
        'start_date',
        'end_date',
        'max_registrations'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function registrants()
    {
        return $this->belongsToMany(User::class);
    }

    public function getHasMaxRegistrantsAttribute()
    {
        return $this->registrants->count() >= $this->max_registrations;
    }
}
