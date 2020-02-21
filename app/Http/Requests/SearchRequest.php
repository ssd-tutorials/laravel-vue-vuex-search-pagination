<?php

namespace App\Http\Requests;

use App\Search\Params;
use App\Search\OrderBy;
use App\Search\Payloads\Payload;
use App\Search\Payloads\SearchOnlyPayload;

use Illuminate\Validation\Rule;

/**
 * Trait SearchRequest
 *
 * @package App\Http\Requests
 *
 * @property string|null $search
 * @property int $per_page
 * @property int $page
 * @property string $order_by
 * @property string $order_field
 * @property string $order_direction
 */
trait SearchRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge([
            'per_page' => [
                'required',
                Rule::in(config('system.per_page')),
            ],
            'page' => [
                'required',
                'integer',
            ],
            'order_by' => [
                'required',
                'string',
            ],
            'order_field' => [
                Rule::in($this->orderByFields()),
            ],
            'order_direction' => [
                Rule::in(['asc', 'desc']),
            ],
        ], $this->searchParams());
    }

    /**
     * Get search parameters.
     *
     * @return array
     */
    protected function searchParams(): array
    {
        return [
            'search' => [
                'present',
            ],
        ];
    }

    /**
     * Get list of available ORDER BY fields.
     *
     * @return array
     */
    abstract protected function orderByFields(): array;

    /**
     * Get default ORDER BY field.
     *
     * @return string
     */
    abstract protected function defaultOrderByField(): string;

    /**
     * Get default ORDER BY direction.
     *
     * @return string
     */
    protected function defaultOrderByDirection(): string
    {
        return 'asc';
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->order_by = $this->order_by ??
            $this->defaultOrderByField().':'.$this->defaultOrderByDirection();

        [$order, $direction] = explode(':', $this->order_by);

        $this->offsetSet('order_field', $order);
        $this->offsetSet('order_direction', $direction);

        $this->per_page = (int)($this->per_page ?? config('system.default_per_page'));
        $this->page = (int)($this->page ?? 1);
    }

    /**
     * Get request parameters.
     *
     * @return \App\Search\Params
     */
    public function requestParams(): Params
    {
        return new Params(
            $this->payload(), $this->per_page, $this->page, $this->order_by
        );
    }

    /**
     * Get search payload.
     *
     * @return \App\Search\Payloads\Payload
     */
    protected function payload(): Payload
    {
        return new SearchOnlyPayload($this->search ?? null);
    }

    /**
     * Get request ORDER BY.
     *
     * @return \App\Search\OrderBy
     */
    public function requestOrder(): OrderBy
    {
        return new OrderBy($this->order_field, $this->order_direction);
    }
}
