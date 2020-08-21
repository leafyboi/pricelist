<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Illuminate\Http\Request;
use App\Models\User;

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

        $user_id = User::find($user_id);

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
                'price_list' => [
                    'id' => $price_list->id,
                ],
                'message' => 'Прайс лист успешно создан.'
            ]);
        }
    }

    public function getUserPriceLists(Request $request)
    {
        $user_id = $request->input('user_id');
        $price_lists = PriceList::where('user_id', $user_id)->orderBy('created_at', 'asc')->get();
        $user = User::find($user_id);
        $sd = $user->name

        if ($user === null) {

        }
    }
}

