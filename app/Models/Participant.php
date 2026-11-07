<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Participant extends Model
{
    // Field yang boleh diisi melalui proses pendaftaran
    protected $fillable = [
        'event_id',
        'name',
        'institution',
        'city',
        'phone',
        'email',
        'payment_proof',
        'ktm_path',
        'information_source',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

