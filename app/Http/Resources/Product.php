<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Product
 *
 * @package App\Http\Resources
 *
 * @property int $id
 * @property string $name
 * @property float $price
 */
class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'edit_url' => route('product.edit', $this->id),
            'destroy_url' => route('product.destroy', $this->id),
        ];
    }
}
