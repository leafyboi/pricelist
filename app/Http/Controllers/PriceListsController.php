<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PriceListsController extends Controller
{
    public function addPriceList(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $user_id = Auth::id();

        $data = [
            'name' => $name,
            'description' => $description,
            'user_id' => $user_id
        ];

        $price_list = PriceList::create($data);

        $user = User::find($user_id);

        if ($user === null) {
            return response()->json([
                'errors' => [
                    'type' => 'UserNotFound',
                    'message' => 'Пользователь с данным ID не найден.'],
                'message' => 'В процессе создания прайс листа произошли ошибки'
            ], 201);
        } else {
            return response()->json([
                'price_list' => [
                    'id' => $price_list->id,
                ],
                'message' => 'Прайс лист успешно создан.'
            ], 201);
        }
    }

    public function getUserPriceLists()
    {
        $user_id = Auth::id();

        $price_lists = PriceList::where('user_id', $user_id)
            ->orderBy('created_at', 'asc')
            ->with('goods')
            ->get();

            return response()->json([
                'price_lists' => $price_lists
            ], 200);

    }

    public function getPriceList(Request $request)
    {
        $price_list_id = $request->input('id');
        $user_id = $request->input('user_id');

        $id = Auth::id();

        $price_list = PriceList::where('id', $price_list_id)
            ->with('goods')
            ->get();

        if ($id !== $user_id) {
            return response()->json([
                'errors' => [
                    'type' => 'PermissionDenied',
                    'message' => 'У вас недостаточно прав для просмотра.'],
                'message' => 'Произошла ошибка.'
            ]);
        } else if ($price_list === null) {
            return response()->json([
                'errors' => [
                    'type' => 'PriceListNotFound',
                    'message' => 'Прайс-лист с данным ID не найден.'],
                'message' => 'В процессе просмотра прайс-листа возникли ошибки'
            ], 201);
        } else {
            return response()->json([
                'price_list' => $price_list
            ], 200);
        }
    }

    public function updatePriceList(Request $request)
    {
        $price_list_id = $request->input('id');
        $user_id = $request->input('user_id');

        $price_list = PriceList::find($price_list_id);

        $id = Auth::id();

        if ($id !== $user_id) {
            return response()->json([
                'errors' => [
                    'type' => 'PermissionDenied',
                    'message' => 'У вас недостаточно прав для просмотра.'],
                'message' => 'Произошла ошибка.'
            ]);
        } else if ($price_list === null) {
            return response()->json([
                'errors' => [
                    'type' => 'PriceListNotFound',
                    'message' => 'Прайс-лист с данным ID не найден.'],
                'message' => 'В процессе обновления информации о прайс-листе возникли ошибки.'
            ],404);
        } else {
            $price_list->fill($request->only([
                'name' => $request->name,
                'description' => $request->description]));
            $price_list->save();

            return response()->json([
                'message' => 'Прайс-лист успешно обновлен.'
            ], 201);
        }
    }

    public function deletePriceList(Request $request)
    {
        $price_list_id = $request->input('id');
        $user_id = $request->input('user_id');

        $id = Auth::id();

        $price_list = PriceList::find($price_list_id);

        if ($id !== $user_id) {
            return response()->json([
                'errors' => [
                    'type' => 'PermissionDenied',
                    'message' => 'У вас недостаточно прав для просмотра.'],
                'message' => 'Произошла ошибка.'
            ]);
        } else if ($price_list === null) {
            return response()->json([
                'errors' => [
                    'type' => 'PriceListNotFound',
                    'message' => 'Прайс-лист с таким id не найден.'],
                'message' => 'В процессе удаления прайс-листа возникли ошибки.'
            ], 404);
        } else {
            $price_list->delete();

            return response()->json([
                'message' => 'Прайс-лист успешно удален.'
            ], 201);
        }
    }
}

