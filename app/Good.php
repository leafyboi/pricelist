<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
        'name', 'description', 'article_code', 'price', 'price_list_id'
    ];

    public function priceLists()
    {
        return $this->belongsToMany('App\PriceList');
    }
}
