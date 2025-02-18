<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bracketmatch extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'match_id';
    public $incrementing = true;
    protected $keyType = 'string';

    // Relasi ke Bracket
    public function bracket()
    {
        return $this->belongsTo(Bracket::class, 'bracket_id', 'bracket_id');
    }

    // Relasi ke Pool (jika ada)
    public function pool()
    {
        return $this->belongsTo(BracketPool::class, 'pool_id', 'pool_id');
    }

    // Relasi ke Peserta 1
    public function participantOne()
    {
        return $this->belongsTo(Participant::class, 'participant_1', 'participant_id');
    }

    // Relasi ke Peserta 2
    public function participantTwo()
    {
        return $this->belongsTo(Participant::class, 'participant_2', 'participant_id');
    }

    // Relasi ke Pemenang
    public function winner()
    {
        return $this->belongsTo(Participant::class, 'winner_id', 'participant_id');
    }
}
