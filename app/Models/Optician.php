<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optician extends Model
{
    use HasFactory;

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }

    public function consumers()
    {
        return $this->hasMany(Consumer::class);
    }

    public function refunds()
    {
        return $this->hasManyThrough(Refund::class, Dossier::class);
    }
}
