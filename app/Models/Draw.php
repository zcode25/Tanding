<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Draw extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'draw_id';
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

    public function register()
    {
        return $this->belongsTo(Register::class, 'register_id', 'register_id');
    }

    public function blueCornerMatchtandings()
    {
        return $this->hasMany(Matchtanding::class, 'blue_corner', 'draw_id');
    }

    public function redCornerMatchtandings()
    {
        return $this->hasMany(Matchtanding::class, 'red_corner', 'draw_id');
    }

    public function winnerMatchtandings()
    {
        return $this->hasMany(Matchtanding::class, 'winner', 'draw_id');
    }

}
