<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Good
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $article_code
 * @property int $price
 * @property int $price_list_id
 *
 * @property PriceList $priceList
 */
class Good extends Model
{
    protected $fillable = [
        'name', 'description', 'article_code', 'price', 'price_list_id'
    ];

    public function priceList()
    {
        return $this->hasOne('App\Models\PriceList');
    }
}
