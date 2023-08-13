<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;
use Exception;

class ItemController extends Controller
{
    private ItemService $itemService;
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function showAll() {
        return $this->successResponse($this->itemService->showAll());
    }
    public function show(int $id) {
        try {
            $data = $this->itemService->show($id);
            return $this->successResponse($data);
        }
        catch (Exception $exception) {
            $this->errorResponse();
        }
    }

    public function update(ItemRequest $request, int $id)
    {
        try {
            $data = $this->itemService->update($request, $id);
            return $this->successResponse($data, "Success, item updated!");
        }
        catch (Exception $exception) {
            $this->errorResponse();
        }
    }

    public function store(ItemRequest $request) {
        try {
            $data = $this->itemService->store($request);
            return $this->successResponse($data);
        }
        catch (Exception $exception) {
            $this->errorResponse("Success, item stored!");
        }
    }

    public function delete($id) {
        try {
            $data = $this->itemService->delete($id);
            return $this->successResponse($data, "Success, item deleted!");
        }
        catch (Exception $exception) {
            $this->errorResponse();
        }
    }

    protected function successResponse($data, $message = null, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    protected function errorResponse($message = 'Something went wrong', $status = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }

}
