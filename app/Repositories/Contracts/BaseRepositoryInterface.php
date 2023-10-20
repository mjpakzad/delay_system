<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @param array $queries
     * @param array $relations
     * @return LengthAwarePaginator|Collection
     */
    public function list(array $queries = [], array $relations = []): LengthAwarePaginator|Collection;

    /**
     * @param Builder $models
     * @param array $queries
     * @return Builder
     */
    public function applyQuery(Builder $models, array $queries = []): Builder;
}