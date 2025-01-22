<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Register extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'register_id';
    public $incrementing = true;
    protected $keyType = 'string';

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

    public function contingent()
    {
        return $this->belongsTo(contingent::class, 'contingent_id');
    }
    
    public function athletes()
    {
        return $this->belongsToMany(Athlete::class, 'registerathletes', 'register_id', 'athlete_id');
    }

    public function registerAthletes()
    {
        return $this->hasMany(RegisterAthlete::class, 'register_id', 'register_id');
    }
}
