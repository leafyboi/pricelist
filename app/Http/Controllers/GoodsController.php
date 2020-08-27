<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    public function addGood(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $articleCode = $request->input('article_code');
        $priceListId = $request->input('price_list_id');

        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'article_code' => $articleCode,
            'price_list_id' => $priceListId
        ];

        $good = Good::create($data);

        $priceList = PriceList::find($priceListId);

        if ($priceList === null) {
            return response()->json([
                'errors' => [
                    'type' => 'PriceListNotFound',
                    'message' => 'Прайс-лист с данным ID не найден.'],
                'message' => 'В процессе добавления товара возникли ошибки.'
            ], 201);
        } else {
            return response()->json([
                'good' => [
                    'id' => $good->id
                    ],
                'message' => 'Товар успешно добавлен.'
            ], 201);
        }
    }

    public function getAllGoods()
    {
        $goods = Good::orderBy('created_at', 'asc')->get();

        return response()->json([
            'goods' => $goods
        ], 200);
    }

    public function getGood(Request $request)
    {
        $goodId = $request->input('id');

        $good = Good::find($goodId);

        if ($good === null) {
            return response()->json([
                'errors' => [
                    'type' => 'GoodNotFound',
                    'message' => 'Товар с данным ID не найден.'],
                'message' => 'В процессе просмотра товара возникли ошибки.'
            ], 404);
        } else {
            return response()->json([
                'good' => $good
            ], 200);
        }
    }

    public function updateGood(Request $request)
    {
        $goodId = $request->input('id');

        $good = Good::find($goodId);

        if ($good === null) {
            return response()->json([
                'errors' => [
                    'type' => 'GoodNotFound',
                    'message' => 'Товар с данным ID не найден.'],
                'message' => 'В процессе обновления товара возникли ошибки.'
            ], 404);
        } else {
            $good->fill($request->only([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'article_code' => $request->article_code
            ]));

            $good->save();

            return response()->json([
                'message' => 'Товар успешно обновлен'
            ], 201);
        }
    }

    public function deleteGood(Request $request)
    {
        $goodId = $request->input('id');

        $good = Good::find($goodId);

        if ($good === null) {
            return response()->json([
                'errors' => [
                    'type' => 'GoodNotFound',
                    'message' => 'Товар с данным ID не найден.'],
                'message' => 'В процессе удаления товара возникли ошибки.'
            ], 404);
        } else {
            $good->delete();

            return response()->json([
                'message' => 'Товар успешно удален.'
            ], 201);
        }
    }
}
