<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contingent extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'contingent_id';
    public $incrementing = true;
    protected $keyType = 'string';
}
