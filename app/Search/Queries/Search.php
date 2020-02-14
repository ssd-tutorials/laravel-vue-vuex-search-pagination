<?php

namespace App\Search\Queries;

use App\Search\OrderBy;
use App\Search\Recordset;
use App\Search\RequestData;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

abstract class Search
{
    /**
     * @var \App\Search\OrderBy
     */
    protected OrderBy $order;

    /**
     * @var \App\Search\RequestData
     */
    protected RequestData $params;

    /**
     * Search constructor.
     *
     * @param  \App\Search\RequestData $params
     * @param  \App\Search\OrderBy $order
     */
    public function __construct(RequestData $params, OrderBy $order)
    {
        $this->order = $order;
        $this->params = $params;
    }

    /**
     * Get response.
     *
     * @return array
     */
    public function response(): array
    {
        return array_merge(
            $this->params->toArray(),
            ['recordset' => $this->recordset()->toArray()]
        );
    }

    /**
     * Get recordset.
     *
     * @return \App\Search\Recordset
     */
    public function recordset(): Recordset
    {
        $query = $this->query()->orderBy($this->order->field, $this->order->direction);

        $total = $query->count('id');

        $lastPage = $this->lastPage($total);

        return new Recordset(
            $this->records($query),
            $total,
            $lastPage,
            $this->prevPage(),
            $this->nextPage($lastPage)
        );
    }

    /**
     * Get sql query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    abstract protected function query(): Builder;

    /**
     * Get records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Support\Collection
     */
    abstract protected function records(Builder $query): Collection;

    /**
     * Add limit query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     */
    protected function limit(Builder $query): void
    {
        $query->take($this->params->perPage)
            ->skip(($this->params->page - 1) * $this->params->perPage);
    }

    /**
     * Get last page.
     *
     * @param  int $total
     * @return int
     */
    protected function lastPage(int $total): int
    {
        return ceil($total / $this->params->perPage) ?: 1;
    }

    /**
     * Get previous page.
     *
     * @return int|null
     */
    protected function prevPage(): ?int
    {
        return $this->params->page === 1 ? null : $this->params->page - 1;
    }

    /**
     * Get next page.
     *
     * @param  int $lastPage
     * @return int|null
     */
    protected function nextPage(int $lastPage): ?int
    {
        return $this->params->page < $lastPage ? $this->params->page + 1 : null;
    }
}
