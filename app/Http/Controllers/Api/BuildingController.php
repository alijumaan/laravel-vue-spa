<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\QuickUpdateBuildingRequest;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use Carbon\Carbon;

class BuildingController extends ApiController
{
    public int $paginate = 10;

    public function index()
    {
        $buildings = Building::with('user')
            ->when(request('search', '') != '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('number', 'LIKE', '%' . request('search') . '%');
                });
            })
            ->orderBy('checked_at')
            ->latest()
            ->paginate($this->paginate);

        $buildings_count = Building::count();

        return $this->respond([
            'buildings' => BuildingResource::collection($buildings),
            'buildings_count' => $buildings_count,
            'pagination' => $this->paginate,
            'auth' => auth()->user()
        ]);
    }

    public function show(Building $building)
    {
        return $this->respond([
            'building' => new BuildingResource($building)
        ]);
    }

    public function store(StoreBuildingRequest $request)
    {
        $this->authorize('add-building');

        Building::create($request->validated());

        return $this->respondCreated();
    }

    public function update(UpdateBuildingRequest $request, Building $building)
    {
        $this->authorize('edit-building');

        $checked_at = $building->checked_at;

        if ($request->status == 1) {
            if ($request->period_id == Building::ONE_MONTH) {
                $checked_at = Carbon::now()->addMonth();
            } elseif ($request->period_id == Building::THREE_MONTHS) {
                $checked_at = Carbon::now()->addDays('90');
            } elseif ($request->period_id == Building::SIX_MONTHS) {
                $checked_at = Carbon::now()->addDays('180');
            } elseif ($request->period_id == Building::YEAR) {
                $checked_at = Carbon::now()->addYear();
            }
        }

        $building->update($request->validated() + [
                'checked_at' => $checked_at
            ]);

        return $this->respondUpdated();

    }

    public function destroy(Building $building)
    {
        $this->authorize('delete-building');

        $building->delete();

        return $this->respondNoContent();
    }

    public function quickUpdate(QuickUpdateBuildingRequest $request, Building $building)
    {
        $this->authorize('update', $building);

        $checked_at = $building->checked_at;

        if ($request->status == 1) {
            if ($request->period_id == Building::ONE_MONTH) {
                $checked_at = Carbon::now()->addMonth();
            } elseif ($request->period_id == Building::THREE_MONTHS) {
                $checked_at = Carbon::now()->addDays('90');
            } elseif ($request->period_id == Building::SIX_MONTHS) {
                $checked_at = Carbon::now()->addDays('180');
            } elseif ($request->period_id == Building::YEAR) {
                $checked_at = Carbon::now()->addYear();
            }
        }

        $building->update($request->validated() + [
                'checked_at' => $checked_at
            ]);

        return $this->respondUpdated();
    }

    public function buildingsHasNotes()
    {
        $buildingsHasNotes = Building::whereNotNull('notes')
            ->paginate($this->paginate);

        return $this->respond([
            'buildingsHasNotes' => BuildingResource::collection($buildingsHasNotes),
            'buildings_has_notes_count' => Building::count()
        ]);
    }
}
