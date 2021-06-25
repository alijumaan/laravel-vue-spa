<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExtinguisherResource extends JsonResource
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
//            'extinguisherType' => $this->type,
            'extinguisherType' => $this->extinguisherType(), // Display on Arabic Language
            'extinguisherCount' => $this->extinguisherBuildings()->where('extinguisher_id', $this->id)->count(),
        ];
    }
}
