<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{

    public function showAll(): JsonResponse {
        return response()->json([
            'message'=>'Success',
            'data'=>(new ItemRepository())->all()
        ],
            200);
    }
    public function show(int $id): JsonResponse {
        return response()->json([
            'message'=>'Success',
            'data'=>(new ItemRepository())->getById($id)
        ], 200);
    }

    public function update(ItemRequest $request, int $id): JsonResponse
    {
        (new ItemRepository())->updateById($id, $request->all());
        return response()->json([
            'message'=>'Success, item updated',
            'data'=>'ok'
        ], 200);
    }

    public function store(ItemRequest $request): JsonResponse {
        (new ItemRepository())->create($request->all());
        return response()->json([
            'message'=>'Success, item created',
            'data'=>'ok'
        ], 200);
    }

    public function delete($id): JsonResponse {
        (new ItemRepository())->deleteById($id);
        return response()->json([
            'message'=>'Success, item deleted',
            'data'=>'ok'
        ], 200);
    }

}
