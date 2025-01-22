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

    public function payments()
    {
        return $this->hasMany(Payment::class, 'contingent_id');
    }

    public function register()
    {
        return $this->hasMany(Register::class, 'contingent_id');
    }

    public function athlete()
    {
        return $this->hasMany(Athlete::class, 'contingent_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
