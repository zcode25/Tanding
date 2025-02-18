<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'event_id';
    public $incrementing = true;
    protected $keyType = 'string';

    public function administrator() {
        return $this->hashMany(administrator::class, 'administrator_id', 'administrator_id');
    }

    public function banners()
    {
        return $this->hasMany(Banner::class, 'event_id');
    }

    public function informations()
    {
        return $this->hasMany(Information::class, 'event_id');
    }

    public function competitions()
    {
        return $this->hasMany(Competition::class, 'event_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'event_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'event_id');
    }

    public function brackets()
    {
        return $this->hasMany(Bracket::class, 'event_id', 'event_id');
    }
}
