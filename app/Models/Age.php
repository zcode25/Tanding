<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Age extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'age_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function competition()
    {
        return $this->hasMany(Competition::class, 'event_id');
    }

    public function athlete()
    {
        return $this->hasMany(Athlete::class, 'age_id');
    }
}
