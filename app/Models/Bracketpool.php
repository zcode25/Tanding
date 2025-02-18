<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bracketpool extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'pool_id';
    public $incrementing = true;
    protected $keyType = 'string';
}
