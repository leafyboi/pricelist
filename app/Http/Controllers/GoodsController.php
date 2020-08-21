<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\PriceList;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function addGood(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $article_code = $request->input('article_code');
        $price_list_id = $request->input('price_list_id');

        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'article_code' => $article_code,
            'price_list_id' => $price_list_id
        ];

        $good = Good::create($data);

        $price_list = PriceList::find($price_list_id);

        if ($price_list === null) {
            return response()->json([
                'errors' => [
                    'type' => 'PriceListNotFound',
                    'message' => 'Прайс-лист с данным ID не найден.'],
                'message' => 'В процессе добавления товара произошли ошибки'
            ], 201);
        }
        else {
            return response()->json([
                'good' => [
                    'id' => $good->id,
                ],
                'message' => 'Товар успешно добавлен.'
            ]);
        }
    }
}
