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
            'name' => $this->name,
            'slug' => $this->slug,
            'number' => $this->number,
            'status' => $this->status,
            'statusText' => $this->status(),
            'notes' => $this->notes,
            'checked_at' => $this->checked_at ? $this->checked_at->format('Y-m-d') : null,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d') : null,
            'checked_at_string' => $this->checked_at ? $this->checked_at->diffForHumans() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d') : null,
            'user_id' => $this->user_id,
            'user' => $this->user->name,
            'period_id' => $this->period_id,
            'count' => $this->count()
        ];
    }
}
