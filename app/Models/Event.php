<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'status',
        'poster',
        'speaker_name',
    ];

    public function categories()
    {
        return $this->hasMany(EventCategory::class);
    }

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
        ];
    }
}