<?php

namespace App\Http\Requests\Product;

use App\Search\OrderBy;
use App\Search\RequestData;
use App\Search\Queries\ProductSearch;
use App\Search\Payloads\SearchOnlyPayload;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FetchRequest
 *
 * @package App\Http\Requests\Product
 *
 * @property string|null $search
 * @property int $per_page
 * @property int $page
 * @property string $order_by
 * @property string $order_field
 * @property string $order_direction
 */
class FetchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'search' => [
                'present',
            ],
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
                Rule::in(['name', 'price']),
            ],
            'order_direction' => [
                Rule::in(['asc', 'desc']),
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->order_by = $this->order_by ?? 'name:asc';

        [$order, $direction] = explode(':', $this->order_by);

        $this->offsetSet('order_field', $order);
        $this->offsetSet('order_direction', $direction);

        $this->per_page = (int)($this->per_page ?? config('system.default_per_page'));
        $this->page = (int)($this->page ?? 1);
    }

    /**
     * Get response.
     *
     * @return array
     */
    public function response(): array
    {
        return (new ProductSearch(
            $this->requestData(), $this->requestOrder()
        ))->response();
    }

    /**
     * Get request data.
     *
     * @return \App\Search\RequestData
     */
    public function requestData(): RequestData
    {
        return new RequestData(
            new SearchOnlyPayload($this->search ?? null), $this->per_page, $this->page, $this->order_by
        );
    }

    /**
     * Get request ORDER BY.
     *
     * @return \App\Search\OrderBy
     */
    protected function requestOrder(): OrderBy
    {
        return new OrderBy($this->order_field, $this->order_direction);
    }
}
