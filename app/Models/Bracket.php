<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bracket extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'bracket_id';
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

    public function matchClass()
    {
        return $this->belongsTo(MatchClass::class, 'class_id', 'class_id');
    }

    public function matches()
    {
        return $this->hasMany(BracketMatch::class, 'bracket_id', 'bracket_id');
    }
}
