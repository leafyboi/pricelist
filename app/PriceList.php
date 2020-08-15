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
        return $this->belongsToMany('App\Good');
    }

    public function users()
    {
        return $this->hasOne('App\User');
    }
}
