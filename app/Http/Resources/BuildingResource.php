<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BuildingResource extends JsonResource
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
            'slug' => $this->slug,
            'name' => $this->name,
            'number' => $this->number,
            'status' => $this->status,
            'statusText' => $this->status(),
            'notes' => $this->notes,
            'checked_at' => $this->checked_at ? $this->checked_at->format('Y-m-d') : null,
            'checked_at_string' => $this->checked_at ? $this->checked_at->diffForHumans() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d') : null,
            'user' => $this->user->name,
            'period_id' => $this->period_id,
            'user_id' => $this->user_id,
            'count' => $this->count(),
        ];
    }
}
