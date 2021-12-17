<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'iso' => $this->iso,
            'phone_code' => $this->phone_code,
            'maxlength' => $this->maxlength,
            'minlength' => $this->minlength,
            'flag' => $this->flag,
            'is_active' => $this->is_active
        ];
        //return parent::toArray($request);
    }
}
