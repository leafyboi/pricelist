<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PriceList
 * @package App\Models
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property Good $goods
 * @property User $user
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

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
