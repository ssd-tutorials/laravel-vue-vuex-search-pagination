<?php

namespace App\Repositories\Eloquent;

use App\Search\Queries\Search;
use App\Search\Queries\ProductSearch;
use App\Http\Requests\SearchFormRequest;
use App\Repositories\Contracts\ProductRepositoryContract;

class ProductRepository implements ProductRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function search(SearchFormRequest $request): Search
    {
        return new ProductSearch(
            $request->requestParams(), $request->requestOrder()
        );
    }
}
