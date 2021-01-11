<?php

namespace Akkurate\LaravelContact\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Email extends JsonResource
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
            'email' => $this->email,
            'priority' => $this->priority,
            'is_active' => $this->is_active,
            'is_default' => $this->is_default,
        ];
    }
}
