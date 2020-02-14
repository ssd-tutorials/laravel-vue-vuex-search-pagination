<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ProductController@index')->name('product');
Route::get('/product/fetch', 'ProductController@fetch')->name('product.fetch');
Route::get('/product/{product_id}/edit', 'ProductController@edit')->name('product.edit');
Route::get('/product/{product_id}/destroy', 'ProductController@destroy')->name('product.destroy');
