<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Services\ItemService;
use Exception;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    private ItemService $itemService;
    public function __construct(ItemService $itemService)
    {
            $this->itemService = $itemService;
    }

    public function showAll(): JsonResponse {
        return $this->successResponse($this->itemService->showAll());
    }
    public function show(int $id) {
        try {
            $data = $this->itemService->show($id);
            return $this->successResponse($data);
        } catch (Exception $exception) {
            return $this->errorResponse('Item doesnt exist');
        }


    }

    public function update(ItemRequest $request, int $id) {
        try {
            $data = $this->itemService->update($request, $id);
            return $this->successResponse($data, "Success, item updated!");
        }
        catch (Exception $exception) {
            return $this->errorResponse('Item doesnt exist');
        }
    }

    public function store(ItemRequest $request) {
        $data = $this->itemService->store($request);
        return $this->successResponse($data, "Success, item stored!");
    }

    public function delete($id) {
        try {
            $data = $this->itemService->delete($id);
            return $this->successResponse($data, "Success, item deleted!");
        }
        catch (Exception $exception) {
            return $this->errorResponse('Item doesnt exist');
        }
    }

}
