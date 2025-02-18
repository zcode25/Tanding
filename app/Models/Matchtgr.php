<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matchtgr extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'matchtgr_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'competition_id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id', 'participant_id');
    }

}
