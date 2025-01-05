<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'competition_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    
}
