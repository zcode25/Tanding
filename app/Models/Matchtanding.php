<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matchtanding extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'matchtanding_id';
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

    public function blueCorner()
    {
        return $this->belongsTo(Draw::class, 'blue_corner', 'draw_id');
    }

    public function redCorner()
    {
        return $this->belongsTo(Draw::class, 'red_corner', 'draw_id');
    }

    public function winner()
    {
        return $this->belongsTo(Draw::class, 'winner', 'draw_id');
    }
}
