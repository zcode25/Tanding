<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'payment_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function contingent()
    {
        return $this->belongsTo(Contingent::class, 'contingent_id');
    }

    public function paymentmethod()
    {
        return $this->belongsTo(Paymentmethod::class, 'paymentmethod_id');
    }
    
}
