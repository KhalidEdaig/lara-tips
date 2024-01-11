<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOption\Option;

class Refund extends Model
{
    use HasFactory;

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function consumer()
    {
        return $this->hasOneThrough(Consumer::class,Dossier::class,'id','id','dossier_id','consumer_id');
    }

    public function optician()
    {
        return $this->hasOneThrough(Optician::class,Dossier::class,'id','id','dossier_id','optician_id');
    }
}
