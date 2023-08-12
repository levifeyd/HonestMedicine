<?php

namespace App\Repositories;


use App\Repositories\BaseRepository;
use App\Models\Item;

class ItemRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     */
    public function model()
    {
        return Item::class;
    }
}
