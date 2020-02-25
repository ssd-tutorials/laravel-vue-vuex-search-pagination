<?php

namespace App\Search\Payloads;

class SearchOnlyPayload extends Payload
{
    /**
     * @var string|null
     */
    public ?string $search;

    /**
     * SearchOnlyPayload constructor.
     *
     * @param  string|null $search
     */
    public function __construct(string $search = null)
    {
        $this->search = $search;
    }

    /**
     * @inheritDoc
     */
    public function hasFilter(): bool
    {
        return (bool)$this->search;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'search' => (string)$this->search,
        ];
    }
}
