<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\Product\FetchRequest;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display products page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('product.index');
    }

    /**
     * Fetch records.
     *
     * @param  \App\Http\Requests\Product\FetchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(FetchRequest $request): JsonResponse
    {
        return new JsonResponse($request->response());
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
