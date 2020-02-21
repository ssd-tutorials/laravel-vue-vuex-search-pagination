<?php

namespace App\Repositories\Contracts;

use App\Search\Queries\Search;
use App\Http\Requests\SearchFormRequest;

interface ProductRepositoryContract
{
    /**
     * Get instance of Search.
     *
     * @param  \App\Http\Requests\SearchFormRequest $request
     * @return \App\Search\Queries\Search
     */
    public function search(SearchFormRequest $request): Search;
}
