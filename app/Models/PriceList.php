<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PriceList
 * @package App\Models
 */
class PriceList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function goods()
    {
        return $this->belongsToMany('App\Good');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users()
    {
        return $this->hasOne('App\User');
    }
}
