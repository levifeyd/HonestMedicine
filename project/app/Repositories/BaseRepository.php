<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository implements RepositoryContract
{
    /**
     * The repository model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The query builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected Builder $query;

    /**
     * Alias for the query limit.
     *
     * @var int
     */
    protected $take;

    /**
     * Array of related models to eager load.
     *
     * @var array
     */
    protected array $with = [];

    /**
     * Array of one or more where clause parameters.
     *
     * @var array
     */
    protected array $wheres = [];

    /**
     * Array of one or more where in clause parameters.
     *
     * @var array
     */
    protected array $whereIns = [];
    /**
     * Array of scope methods to call on the model.
     *
     * @var array
     */
    protected array $scopes = [];

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Specify Model class name.
     */
    abstract public function model();

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed|Model
     *
     * @throws Exception
     */
    public function makeModel()
    {
        $model = resolve($this->model());
        if (! $model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of " . Model::class);
        }
        return $this->model = $model;
    }

    /**
     * Get all the model records in the database.
     *
     * @return array<static>|Collection
     */
    public function all(array $columns = ['*'])
    {
        $this->newQuery();
        $models = $this->query->get($columns);
        $this->unsetClauses();
        return $models;
    }

    /**
     * Create a new model record in the database.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $this->unsetClauses();
        return $this->model->create($data);
    }

    /**
     * Delete the specified model record from the database.
     *
     * @param $id
     * @return bool
     *
     * @throws Exception
     */
    public function deleteById($id): bool
    {
        $this->unsetClauses();
        return $this->getById($id)->delete();
    }

    /**
     * Get the first specified model record from the database.
     *
     * @return Model
     */
    public function first(array $columns = ['*'])
    {
        $this->newQuery();
        $model = $this->query->firstOrFail($columns);
        $this->unsetClauses();
        return $model;
    }

    /**
     * Get all the specified model records in the database.
     *
     * @return array<static>|Collection
     */
    public function get(array $columns = ['*'])
    {
        $this->newQuery();
        $models = $this->query->get($columns);
        $this->unsetClauses();
        return $models;
    }

    /**
     * Get the specified model record from the database.
     *
     * @param $id
     * @return Collection|Model
     */
    public function getById($id, array $columns = ['*'])
    {
        $this->unsetClauses();
        $this->newQuery();
        return $this->query->findOrFail($id, $columns);
    }

    /**
     * @param  string  $item
     * @param  string  $column
     * @return null|Model|static
     */
    public function getByColumn($item, $column, array $columns = ['*'])
    {
        $this->unsetClauses();
        $this->newQuery();
        return $this->query->where($column, $item)->first($columns);
    }

    /**
     * Update the specified model record in the database.
     *
     * @param $id
     * @return Collection|Model
     */
    public function updateById($id, array $data, array $options = [])
    {
        $this->unsetClauses();
        $model = $this->getById($id);
        $model->update($data, $options);
        return $model;
    }

    /**
     * Create a new instance of the model's query builder.
     *
     * @return $this
     */
    protected function newQuery()
    {
        $this->query = $this->model->newQuery();
        return $this;
    }

    /**
     * Reset the query clause parameter arrays.
     *
     * @return $this
     */
    protected function unsetClauses()
    {
        $this->wheres = [];
        $this->whereIns = [];
        $this->scopes = [];
        $this->take = null;
        return $this;
    }
}
