<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontingen extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'kontingen_id';
    public $incrementing = true;
    protected $keyType = 'string';
}
