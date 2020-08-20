<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function addGood(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $article_code = $request->input('article_code');

        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'article_code' => $article_code
        ];

        $good = Good::create($data);

            return response()->json([
                'good' => [
                    'id' => $good->id,
                ],
                'message' => 'Товар успешно добавлен.'
            ]);
        }
}
