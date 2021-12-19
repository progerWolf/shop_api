<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'address' => $this->address,
            'description' => $this->description,
            'phone' => $this->phone,
            'image' => $this->image,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'opening_hour' => $this->opening_hour,
            'closing_hour' => $this->closing_hour,
            'delivery_price' => $this->delivery_price,
            'purchase' => $this->purchase,
            'status' => $this->status,
            'category' => $this->category
        ];

        // return parent::toArray($request);
    }
}
