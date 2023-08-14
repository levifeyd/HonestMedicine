<?php

namespace App\Services;

use App\Http\Requests\ItemRequest;
use App\Repositories\ItemRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ItemService
{
    private ItemRepository $itemRepository;
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function showAll():Collection {
        return $this->itemRepository->all();
    }
    public function show($id): Model {
        return $this->itemRepository->getById($id);
    }

    public function update(ItemRequest $request, int $id): Model {
        return $this->itemRepository->updateById($id, $request->all());
    }

    public function store(ItemRequest $request):Model {
        return $this->itemRepository->create($request->all());
    }

    public function delete($id):bool {
        try {
            $item = $this->itemRepository->deleteById($id);
            return $item;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
