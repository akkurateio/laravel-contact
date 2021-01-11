<?php

namespace Akkurate\LaravelContact\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'type' => $this->type,
            'name' => $this->name,
            'street1' => $this->street1,
            'street2' => $this->street2,
            'street3' => $this->street3,
            'zip' => $this->zip,
            'city' => $this->city,
            'priority' => $this->priority,
            'is_active' => $this->is_active,
            'is_default' => $this->is_default,
            'addressable' => $this->addressable,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
