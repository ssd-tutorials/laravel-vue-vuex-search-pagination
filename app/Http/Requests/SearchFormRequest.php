<?php

namespace App\Http\Requests;

use App\Search\Params;
use App\Search\OrderBy;

interface SearchFormRequest
{
    /**
     * Get request parameters.
     *
     * @return \App\Search\Params
     */
    public function requestParams(): Params;

    /**
     * Get request ORDER BY.
     *
     * @return \App\Search\OrderBy
     */
    public function requestOrder(): OrderBy;
}
