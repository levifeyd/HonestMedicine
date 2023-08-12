<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{

    public function show($id): JsonResponse {
        return response()->json((new ItemRepository())->getById($id));
    }

    public function update(ItemRequest $request): JsonResponse
    {
        Item::query()->update([$request->all()]);
        return response()->json('Success, item edited');
    }

    public function store(ItemRequest $request) {
        $item = Item::query()->create($request->all());
        return $this->sendResponse($item,'Success, item crated');
    }

    public function delete($id) {
        Item::query()->findl($id)->delete();
        return $this->sendResponse('Success, item deleted');
    }

}
