<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FetchProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        config(['system.per_page' => [1, 2, 3]]);
        config(['system.default_per_page' => [1]]);
    }

    /**
     * @test
     */
    public function validation_fails_with_empty_request()
    {
        $response = $this->getJson(route('product.fetch'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'errors' => [
                'search' => [__('validation.present', ['attribute' => 'search'])],
                'order_by' => [__('validation.required', ['attribute' => 'order by'])],
                'per_page' => [__('validation.required', ['attribute' => 'per page'])],
                'page' => [__('validation.required', ['attribute' => 'page'])],
            ],
            'message' => 'The given data was invalid.'
        ]);
    }

    /**
     * @test
     */
    public function validation_fails_with_invalid_values()
    {
        $response = $this->getJson(route('product.fetch', [
            'search' => '',
            'per_page' => 4,
            'page' => 'a',
            'order_by' => 'invalid:sort',
        ]));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'errors' => [
                'order_field' => [__('validation.in', ['attribute' => 'order field'])],
                'order_direction' => [__('validation.in', ['attribute' => 'order direction'])],
                'per_page' => [__('validation.in', ['attribute' => 'per page'])],
                'page' => [__('validation.integer', ['attribute' => 'page'])],
            ],
            'message' => 'The given data was invalid.'
        ]);
    }

    /**
     * @test
     */
    public function returns_records_with_default_filter()
    {
        $products = factory(Product::class, 15)->create()->sortBy('name');


        $response = $this->getJson(route('product.fetch', [
            'search' => '',
            'per_page' => 1,
            'page' => 1,
            'order_by' => 'name:asc',
        ]));

        $records = $products->skip(0)->take(1)->map(function (Product $product) {
            return array_merge(
                $product->only('name', 'id', 'price'),
                [
                    'edit_url' => route('product.edit', $product->id),
                    'destroy_url' => route('product.destroy', $product->id),
                ]
            );
        })->values()->toArray();

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'search' => null,
            'per_page' => 1,
            'page' => 1,
            'order_by' => 'name:asc',
            'recordset' => [
                'total' => 15,
                'prev_page' => null,
                'next_page' => 2,
                'last_page' => 15,
                'records' => $records,
            ],
        ]);
    }
}
