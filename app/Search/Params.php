<?php

namespace App\Search;

use App\Search\Payloads\Payload;

use Illuminate\Contracts\Support\Arrayable;

class Params implements Arrayable
{
    /**
     * @var \App\Search\Payloads\Payload
     */
    public Payload $search;

    /**
     * @var int
     */
    public int $perPage;

    /**
     * @var int
     */
    public int $page;

    /**
     * @var string
     */
    public string $orderBy;

    /**
     * Params constructor.
     *
     * @param  \App\Search\Payloads\Payload $search
     * @param  int $perPage
     * @param  int $page
     * @param  string $orderBy
     */
    public function __construct(Payload $search, int $perPage, int $page, string $orderBy)
    {
        $this->page = $page;
        $this->search = $search;
        $this->perPage = $perPage;
        $this->orderBy = $orderBy;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge([
            'per_page' => $this->perPage,
            'page' => $this->page,
            'order_by' => $this->orderBy,
        ], $this->search->toArray());
    }
}
