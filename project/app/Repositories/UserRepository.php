<?php

namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     */
    public function model()
    {
        return User::class;
    }
}
