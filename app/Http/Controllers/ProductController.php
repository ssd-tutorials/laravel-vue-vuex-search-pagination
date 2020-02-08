<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

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
}
