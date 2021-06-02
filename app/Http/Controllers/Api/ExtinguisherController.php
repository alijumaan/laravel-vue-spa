<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreExtinguisherRequest;
use App\Http\Resources\ExtinguisherResource;
use App\Models\BuildingExtinguisher;
use App\Models\Extinguisher;

class ExtinguisherController extends ApiController
{
    public function index()
    {
        $extinguishers = Extinguisher::with('extinguisherBuildings')->get();

        return $this->respond([
            'data' => ExtinguisherResource::collection($extinguishers)
        ]);
    }

    public function show(Extinguisher $extinguisher)
    {
        $buildings = $extinguisher->extinguisherBuildings;

        return $this->respond([
            'extinguisher' => new ExtinguisherResource($extinguisher),
            'buildings' => $buildings
        ]);
    }

    public function getExtinguishersType()
    {
        $extinguishersType = Extinguisher::select('id', 'type')->distinct()->get();

        return $this->respond([
            'extinguishersType' => $extinguishersType
        ]);
    }

    public function store(StoreExtinguisherRequest $request)
    {
        BuildingExtinguisher::create($request->validated());

        return $this->respondCreated();
    }

    public function delete($extinguisherId, $buildingId)
    {
        BuildingExtinguisher::where('extinguisher_id', $extinguisherId)
            ->where('building_id', $buildingId)
            ->delete();

        return $this->respondNoContent();
    }
}
