<?php

namespace App\Search\Queries;

use App\Product;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class ProductSearch extends Search
{
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

    /**
     * @inheritDoc
     */
    protected function records(Builder $query): Collection
    {
        $this->limit($query);

        return $query->get()->map(function (Product $product) {
            return array_merge(
                $product->only('id', 'name', 'price'),
                [
                    'edit_url' => route('product.edit', $product->id),
                    'destroy_url' => route('product.destroy', $product->id),
                ]
            );
        })->values();
    }
}
