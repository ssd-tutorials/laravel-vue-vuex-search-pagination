<?php

namespace App\Search;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Arrayable;

class Recordset implements Arrayable
{
    /**
     * @var \Illuminate\Support\Collection
     */
    public Collection $records;

    /**
     * @var int
     */
    public int $total;

    /**
     * @var int
     */
    public int $lastPage;

    /**
     * @var int|null
     */
    public ?int $prevPage;

    /**
     * @var int|null
     */
    public ?int $nextPage;

    /**
     * Recordset constructor.
     *
     * @param  \Illuminate\Support\Collection $records
     * @param  int $total
     * @param  int $lastPage
     * @param  int|null $prevPage
     * @param  int|null $nextPage
     */
    public function __construct(
        Collection $records,
        int $total,
        int $lastPage,
        int $prevPage = null,
        int $nextPage = null
    )
    {
        $this->total = $total;
        $this->records = $records;
        $this->lastPage = $lastPage;
        $this->prevPage = $prevPage;
        $this->nextPage = $nextPage;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'prev_page' => $this->prevPage,
            'next_page' => $this->nextPage,
            'last_page' => $this->lastPage,
            'records' => $this->records,
        ];
    }
}
