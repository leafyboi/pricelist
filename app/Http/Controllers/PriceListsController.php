<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\PriceList;
use Illuminate\Http\Request;

class PriceListsController extends Controller
{
    public function addPriceList(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $user_id = $request->input('user_id');

        $data = [
            'name' => $name,
            'description' => $description,
            'user_id' => $user_id
        ];

        $price_list = PriceList::create($data);

        $user_id = PriceList::find($user_id);

        if ($user_id === null) {
            return response()->json([
                'errors' => [
                    'type' => 'UserNotFound',
                    'message' => 'Пользователь с данным ID не найден.'],
                'message' => 'В процессе создания прайс листа произошли ошибки'
            ], 201);
        }
        else {
            return response()->json([
                'good' => [
                    'id' => $price_list->id,
                ],
                'message' => 'Прайс лист успешно создан.'
            ]);
        }
    }
}

