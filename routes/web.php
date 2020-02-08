<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ProductController@index')->name('product');
