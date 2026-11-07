<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\Participant;

class EventCategory extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'normal_price',
        'early_bird_price',
        'early_bird_start',
        'early_bird_end',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'normal_price' => 'decimal:2',
            'early_bird_price' => 'decimal:2',
            'early_bird_start' => 'datetime',
            'early_bird_end' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
