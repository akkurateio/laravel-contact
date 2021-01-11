<?php

namespace Akkurate\LaravelContact\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Phone extends JsonResource
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
            'number' => $this->number,
            'priority' => $this->priority,
            'is_active' => $this->is_active,
            'is_default' => $this->is_default,
            'phoneable' => $this->phoneable,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
