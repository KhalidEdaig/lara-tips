<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    use HasFactory;

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }

    public function refunds()
    {
        return $this->hasManyThrough(Refund::class, Dossier::class);
    }
}
