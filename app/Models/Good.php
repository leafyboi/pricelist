<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Good
 * @package App
 */
class Good extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'article_code', 'price', 'price_list_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function priceLists()
    {
        return $this->belongsToMany('App\PriceList');
    }
}
