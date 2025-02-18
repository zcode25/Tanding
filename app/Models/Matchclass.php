<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matchclass extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'class_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function age()
    {
        return $this->belongsTo(Age::class, 'age_id', 'age_id');
    }

    public function brackets()
    {
        return $this->hasMany(Bracket::class, 'class_id', 'class_id');
    }
}
