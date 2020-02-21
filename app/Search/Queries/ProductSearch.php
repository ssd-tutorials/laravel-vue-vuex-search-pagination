<?php

namespace App\Search\Queries;

use App\Product;

use Illuminate\Database\Eloquent\Builder;

class ProductSearch extends Search
{
    use EloquentSearch;

    /**
     * @inheritDoc
     */
    protected function query(): Builder
    {
        $query = Product::query();

        if ($this->params->search->hasFilter()) {
            $query->where('name', 'like', '%'.$this->params->search->search.'%');
        }

        return $query;
    }
}
