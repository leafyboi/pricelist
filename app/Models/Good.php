<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Good
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $articleCode
 * @property int $price
 * @property int $priceListId
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
