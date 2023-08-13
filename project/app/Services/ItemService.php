<?php

namespace App\Services;

use App\Http\Requests\ItemRequest;
use App\Repositories\ItemRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ItemService
{

    public function showAll():Collection {
        return (new ItemRepository())->all();
    }
    public function show($id):Model {
        return (new ItemRepository())->getById($id);
    }

    public function update(ItemRequest $request, int $id):Model {
        return (new ItemRepository())->updateById($id, $request->all());
    }

    public function store(ItemRequest $request):Model {
        return (new ItemRepository())->create($request->all());
    }

    public function delete($id):bool {
        try {
            (new ItemRepository())->deleteById($id);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
