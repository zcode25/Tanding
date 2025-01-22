<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Athlete extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'athlete_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function age()
    {
        return $this->belongsTo(Age::class, 'age_id');
    }

    public function contingent()
    {
        return $this->belongsTo(Contingent::class, 'contingent_id');
    }

}
