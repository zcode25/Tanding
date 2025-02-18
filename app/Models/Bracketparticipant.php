<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bracketparticipant extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'bracketpart_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function bracket()
    {
        return $this->belongsTo(Bracket::class, 'bracket_id', 'bracket_id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id', 'participant_id');
    }

    public function pool()
    {
        return $this->belongsTo(BracketPool::class, 'pool_id', 'pool_id');
    }
}
