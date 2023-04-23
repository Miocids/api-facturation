<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\{RepositoryInterface};

class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model table
     */
    private Model $_repository;

    public function __construct(Model $model)
    {
        $this->setRepository($model);
    }

    public function all(): Collection
    {
        // TODO: Implement all() method.
        return $this->repository->all();
    }

    public function save(array $data, array $attributes): ?Model
    {
        // TODO: Implement create() method.
        return $this->repository->updateOrCreate($data,$attributes);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        return $this->repository->find($id)->delete();
    }

    public function getById($id): ?Model
    {
        // TODO: Implement find() method.
        return $this->repository->find($id);
    }

    public function filterIn(string $field, array $data): ?Collection
    {
        // TODO: Implement filterIn() method.
        return $this->repository->whereIn($field, $data)->get();
    }

    public function getBy(array $attributes): ?Model
    {
        // TODO: Implement filterIn() method.
        return $this->repository->firstWhere($attributes);
    }

    public function filterBy(array $data): Collection
    {
        // TODO: Implement filters() method.
        return $this->repository->where($data)->get();
    }

    protected function setRepository(Model $model): BaseRepository
    {
        // TODO: Implement setRepository() method.
        $this->_repository = $model;
        return $this;
    }

    protected function getRepository(): ?Model
    {
        // TODO: Implement getRepository() method.
        return $this->_repository;
    }

}