<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PriceList
 * @package App\Models
 * @property string $name
 * @property string $description
 * @property int $user_id
 */
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
