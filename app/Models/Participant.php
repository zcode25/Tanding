<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'participant_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'participant_id';
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function age()
    {
        return $this->belongsTo(Age::class, 'age_id');
    }

    public function matchClass()
    {
        return $this->belongsTo(Matchclass::class, 'class_id');
    }

    public function matchesAsParticipantOne()
    {
        return $this->hasMany(BracketMatch::class, 'participant_1', 'participant_id');
    }

    public function matchesAsParticipantTwo()
    {
        return $this->hasMany(BracketMatch::class, 'participant_2', 'participant_id');
    }

    public function matchesAsWinner()
    {
        return $this->hasMany(BracketMatch::class, 'winner_id', 'participant_id');
    }

    public function matchtgrs()
    {
        return $this->hasMany(Matchtgr::class, 'participant_id', 'participant_id');
    }
}
