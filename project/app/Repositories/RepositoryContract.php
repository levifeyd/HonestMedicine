<?php

namespace App\Repositories;

interface RepositoryContract
{
    public function all(array $columns = ['*']);


    public function create(array $data);


    public function deleteById(int $id);

    public function first(array $columns = ['*']);

    public function get(array $columns = ['*']);

    public function getById(int $id, array $columns = ['*']);

    public function getByColumn($item, $column, array $columns = ['*']);

    public function updateById(int $id, array $data, array $options = []);

    public function orderBy($column, $value);


}
