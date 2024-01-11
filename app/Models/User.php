<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;
use Throwable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Encryptable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'bod',
        'age',
        'city',
        'company',
        'amount',
        'cin',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $attributesCryptable = [
        'name',
        'email',
        'cin'
    ];

    // public function setCinAttribute($value)
    // {
    //     $this->attributes['cin'] = Crypt::encrypt($value);
    // }


    public function meters(): HasMany
    {
        return $this->hasMany(Meter::class);
    }

    public function getCinAttribute($value)
    {
        return $this->tryToDecrypt($value);
    }

    public function getNameAttribute($value)
    {
        return $this->tryToDecrypt($value);
    }
    
    public function getEmailAttribute($value)
    {
        return $this->tryToDecrypt($value);
    }

    private function tryToDecrypt($value)
    {
        try {
            return  Crypt::decrypt($value);
        } catch (Throwable $th) {
            return $value;
        }
    }

    public function password($value)
    {
        set:
        fn () => bcrypt($value);
    }
}
