<?php

namespace App\Repositories;

use App\Interfaces\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    abstract public function getModel(): Model;

    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->getModel()->newQuery();
    }

    /**
     * @param array|null $select
     * @param array|null $with
     * @return Collection
     */
    public function getAll(?array $select = ['*'], ?array $with = []): Collection
    {
        $query = $this->getQuery()->with($with)->select($select);

        return $query->get();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->getQuery()->create($data);
    }
}
