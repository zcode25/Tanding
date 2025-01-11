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
}
