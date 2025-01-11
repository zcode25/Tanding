<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'category_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function competition()
    {
        return $this->hasMany(Competition::class, 'event_id');
    }

    public function registers()
    {
        return $this->hasMany(Register::class, 'category_id');
    }
}
