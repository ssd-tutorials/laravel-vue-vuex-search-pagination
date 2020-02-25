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
            'params' => [
                'search' => '',
                'per_page' => 1,
                'page' => 1,
                'order_by' => 'name:asc',
            ],
            'meta' => [
                'total' => 15,
                'prev_page' => null,
                'next_page' => 2,
                'last_page' => 15,
            ],
            'records' => $records,
        ]);
    }

    /**
     * @test
     */
    public function returns_filtered_records()
    {
        $products = collect([
            factory(Product::class)->create([
                'id' => 1, 'name' => 'Trek Remedy 7 27.5', 'price' => '2200.00'
            ]),
            factory(Product::class)->create([
                'id' => 2, 'name' => 'Trek Remedy 8 27.5', 'price' => '2700.00'
            ]),
            factory(Product::class)->create([
                'id' => 3, 'name' => 'Trek Remedy 9.7 27.5', 'price' => '3300.00'
            ]),
            factory(Product::class)->create([
                'id' => 4, 'name' => 'Yeti SB165 27.5', 'price' => '5599.00'
            ]),
            factory(Product::class)->create([
                'id' => 5, 'name' => 'Yeti SB150 29', 'price' => '5699.00'
            ]),
            factory(Product::class)->create([
                'id' => 6, 'name' => 'Kona Process 153 CR/DL 27.5', 'price' => '3500.00'
            ]),
            factory(Product::class)->create([
                'id' => 7, 'name' => 'Kona Hei Hei 29', 'price' => '3650.00'
            ]),
        ]);

        $response = $this->getJson(route('product.fetch', [
            'search' => '27.5',
            'order_by' => 'price:desc',
            'per_page' => 2,
            'page' => 2,
        ]));

        $records = $products->whereIn('id', [1, 2, 3, 4, 6])->map(function (Product $product) {
            return array_merge(
                $product->only('name', 'id', 'price'),
                [
                    'edit_url' => route('product.edit', $product->id),
                    'destroy_url' => route('product.destroy', $product->id),
                ]
            );
        })->sortByDesc('price')->skip(2)->take(2)->values()->toArray();

        $response->assertStatus(Response::HTTP_OK);

        $response->assertExactJson([
            'params' => [
                'search' => '27.5',
                'order_by' => 'price:desc',
                'per_page' => 2,
                'page' => 2,
            ],
            'meta' => [
                'total' => 5,
                'prev_page' => 1,
                'next_page' => 3,
                'last_page' => 3,
            ],
            'records' => $records,
        ]);
    }

    /**
     * @test
     */
    public function overwrites_last_page_if_current_page_exceeds_number_of_available_pages()
    {
        $products = factory(Product::class, 15)->create()->sortBy('name');


        $response = $this->getJson(route('product.fetch', [
            'search' => '',
            'per_page' => 1,
            'page' => 16,
            'order_by' => 'name:asc',
        ]));

        $records = $products->skip(14)->take(1)->map(function (Product $product) {
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
            'params' => [
                'search' => '',
                'per_page' => 1,
                'page' => 15,
                'order_by' => 'name:asc',
            ],
            'meta' => [
                'total' => 15,
                'prev_page' => 14,
                'next_page' => null,
                'last_page' => 15,
            ],
            'records' => $records,
        ]);
    }
}
