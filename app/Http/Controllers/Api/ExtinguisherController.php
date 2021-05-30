<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreExtinguisherRequest;
use App\Http\Resources\ExtinguisherResource;
use App\Models\Building;
use App\Models\BuildingExtinguisher;
use App\Models\Extinguisher;
use Illuminate\Database\Eloquent\Model;

class ExtinguisherController extends ApiController
{
//    public function index()
//    {
//        $extinguishers = Extinguisher::with('extinguisherBuildings')->get();
//
//        return ExtinguisherResource::collection($extinguishers);
//    }

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
        $extinguishersType = Extinguisher::all()->unique('type')->values()->all();

        return $this->respond([
            'extinguishersType' => $extinguishersType
        ]);
    }

    public function store(StoreExtinguisherRequest $request)
    {
        $buildingExtinguisher = new BuildingExtinguisher();

        if ($buildingExtinguisher) {
            $buildingExtinguisher['building_id'] = $request->building_id;
            $buildingExtinguisher['extinguisher_id'] = $request->extinguisher_id;
            $buildingExtinguisher->save();

            return $this->respondCreated();
        }

        return $this->respondInternalError();
    }

    public function restore($extinguisherId, $buildingId)
    {
        BuildingExtinguisher::where('extinguisher_id', $extinguisherId)
            ->where('building_id', $buildingId)
            ->delete();
    }
}
