#Laravel, VueJs and Vuex: Search component with Pagination

Exercise files for the course `Laravel, VueJs and Vuex: Search component with Pagination`

```php
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
```
