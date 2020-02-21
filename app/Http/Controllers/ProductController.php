<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Resources\SearchCollection;
use App\Http\Requests\Product\FetchRequest;
use App\Http\Resources\Product as ProductResource;
use App\Repositories\Contracts\ProductRepositoryContract;

use Illuminate\View\View;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * @var \App\Repositories\Contracts\ProductRepositoryContract
     */
    private ProductRepositoryContract $repository;

    /**
     * ProductController constructor.
     *
     * @param  \App\Repositories\Contracts\ProductRepositoryContract $repository
     */
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display products page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('product.index')
            ->with('perPage', new Collection(config('system.per_page')))
            ->with('defaultPerPage', config('system.default_per_page'));
    }

    /**
     * Fetch records.
     *
     * @param  \App\Http\Requests\Product\FetchRequest $request
     * @return \App\Http\Resources\SearchCollection
     */
    public function fetch(FetchRequest $request): SearchCollection
    {
        return new SearchCollection(
            $this->repository->search($request), ProductResource::class
        );
    }

    /**
     * Get edit form.
     *
     * @param  \App\Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product): View
    {
        return view('product.edit')->with('product', $product);
    }

    /**
     * Remove record.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return new RedirectResponse(route('product'));
    }
}
