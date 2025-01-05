<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrator extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'administrator_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
