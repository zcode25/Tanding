<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paymentmethod extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'paymentmethod_id';
    public $incrementing = true;
    protected $keyType = 'string';

   
    public function payments()
    {
        return $this->hasMany(Payment::class, 'paymentmethod_id');
    }
}

