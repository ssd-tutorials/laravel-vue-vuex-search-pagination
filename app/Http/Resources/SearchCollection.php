<?php

namespace App\Http\Resources;

use App\Search\Meta;
use App\Search\Params;
use App\Search\Queries\Search;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchCollection extends ResourceCollection
{
    /**
     * @var \App\Search\Meta
     */
    private Meta $meta;

    /**
     * @var \App\Search\Params
     */
    private Params $params;

    /**
     * SearchCollection constructor.
     *
     * @param  \App\Search\Queries\Search $search
     * @param  string $collects
     */
    public function __construct(Search $search, string $collects)
    {
        $this->collects = $collects;
        $this->meta = $search->meta();
        $this->params = $search->params();

        parent::__construct($search->records());
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'records' => $this->collection,
            'params' => $this->params->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
