<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registerathlete extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'registerathlete_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id', 'athlete_id');
    }

    public function register()
    {
        return $this->belongsTo(Register::class, 'register_id');
    }

}
