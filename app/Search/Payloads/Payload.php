<?php

namespace App\Search\Payloads;

use Illuminate\Contracts\Support\Arrayable;

abstract class Payload implements Arrayable
{
    /**
     * Determine if payload has query filter.
     *
     * @return bool
     */
    abstract public function hasFilter(): bool;
}
