<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{

    public function showAll(): JsonResponse {
        return response()->json((new ItemRepository())->all());
    }
    public function show($id): JsonResponse {
        return response()->json((new ItemRepository())->getById($id));
    }

    public function update(ItemRequest $request, int $id): JsonResponse
    {
        (new ItemRepository())->updateById($id, $request->all());
        return response()->json('Success, item updated');
    }

    public function store(ItemRequest $request): JsonResponse {
        (new ItemRepository())->create($request->all());
        return response()->json('Success, item created');
    }

    public function delete($id): JsonResponse {
        (new ItemRepository())->deleteById($id);
        return response()->json('Success, item deleted');
    }

}
