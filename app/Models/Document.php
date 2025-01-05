<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'document_id';
    public $incrementing = true;
    protected $keyType = 'string';
}
