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

        $userId = Auth::id();

        $data = [
            'name' => $name,
            'description' => $description,
            'user_id' => $userId
        ];

        $priceList = PriceList::create($data);

        $user = User::find($userId);

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
                    'id' => $priceList->id,
                ],
                'message' => 'Прайс лист успешно создан.'
            ], 201);
        }
    }

    public function getUserPriceLists()
    {
        $userId = Auth::id();

        $price_lists = PriceList::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->with('goods')
            ->get();

            return response()->json([
                'price_lists' => $price_lists
            ], 200);

    }

    public function getPriceList(Request $request)
    {
        $priceListId = $request->input('id');
        $userId = $request->input('user_id');


        $priceList = PriceList::where('id', $priceListId)
            ->with('goods')
            ->get();

        if (Auth::id() !== $userId) {
            return response()->json([
                'errors' => [
                    'type' => 'PermissionDenied',
                    'message' => 'У вас недостаточно прав для просмотра.'],
                'message' => 'Произошла ошибка.'
            ]);
        } else if ($priceList === null) {
            return response()->json([
                'errors' => [
                    'type' => 'PriceListNotFound',
                    'message' => 'Прайс-лист с данным ID не найден.'],
                'message' => 'В процессе просмотра прайс-листа возникли ошибки'
            ], 201);
        } else {
            return response()->json([
                'price_list' => $priceList
            ], 200);
        }
    }

    public function updatePriceList(Request $request)
    {
        $priceListId = $request->input('id');
        $userId = $request->input('user_id');

        $priceList = PriceList::find($priceListId);


        if (Auth::id() !== $userId) {
            return response()->json([
                'errors' => [
                    'type' => 'PermissionDenied',
                    'message' => 'У вас недостаточно прав для просмотра.'],
                'message' => 'Произошла ошибка.'
            ]);
        } else if ($priceList === null) {
            return response()->json([
                'errors' => [
                    'type' => 'PriceListNotFound',
                    'message' => 'Прайс-лист с данным ID не найден.'],
                'message' => 'В процессе обновления информации о прайс-листе возникли ошибки.'
            ],404);
        } else {
            $priceList->fill($request->only([
                'name' => $request->name,
                'description' => $request->description]));
            $priceList->save();

            return response()->json([
                'message' => 'Прайс-лист успешно обновлен.'
            ], 201);
        }
    }

    public function deletePriceList(Request $request)
    {
        $priceListId = $request->input('id');
        $userId = $request->input('user_id');

        $priceList = PriceList::find($priceListId);

        if (Auth::id() !== $userId) {
            return response()->json([
                'errors' => [
                    'type' => 'PermissionDenied',
                    'message' => 'У вас недостаточно прав для просмотра.'],
                'message' => 'Произошла ошибка.'
            ]);
        } else if ($priceList === null) {
            return response()->json([
                'errors' => [
                    'type' => 'PriceListNotFound',
                    'message' => 'Прайс-лист с таким id не найден.'],
                'message' => 'В процессе удаления прайс-листа возникли ошибки.'
            ], 404);
        } else {
            $priceList->delete();

            return response()->json([
                'message' => 'Прайс-лист успешно удален.'
            ], 201);
        }
    }
}

