<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class User
 * @package App\Models
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $api_token
 *
 * @property User $user
 * @property PriceList $priceList
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function priceLists()
    {
        return $this->belongsToMany('App\Models\PriceList');
    }

    public function generateToken()
    {
        $this->api_token = $token = Str::random(60);
        Auth::user()->api_token = $this->api_token;
        Auth::user()->save();
        return $this->api_token;
    }
}
