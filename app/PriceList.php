<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    public function goods()
    {
        return $this->hasMany('App\PriceList');
    }
}
