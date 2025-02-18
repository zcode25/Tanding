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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function age()
    {
        return $this->belongsTo(Age::class, 'age_id');
    }

    public function brackets()
    {
        return $this->hasMany(Bracket::class, 'competition_id', 'competition_id');
    }

    public function matchtgrs()
    {
        return $this->hasMany(Matchtgr::class, 'competition_id', 'competition_id');
    }
    
}
