<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\QuickUpdateBuildingRequest;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class BuildingController extends ApiController
{
    public function index()
    {
        $pagination = 10;
        $buildings = Building::with('user')
            ->when(request('search', '') != '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search') . '%')
                        ->orWhere('number', 'LIKE', '%' . request('search') . '%');
                });
            })
            ->orderBy('checked_at')
            ->latest()
            ->paginate($pagination);

        if (!$buildings) {
            return $this->respondNotFound('المبنى غير موجود');
        }

        $buildings_count = Building::count();

        return $this->respond([
            'data' => BuildingResource::collection($buildings),
            'count' => $buildings_count,
            'pagination' => $pagination
        ]);
    }

    public function show(Building $building)
    {
        if (!$building) {
            return $this->respondNotFound('المبنى غير موجود');
        }

        return $this->respond([
            'data' => new BuildingResource($building)
        ]);
    }

    public function store(StoreBuildingRequest $request)
    {
        abort_if(!auth()->user()->can('add-building'), 403, 'ليس لديك الصلاحيات على انشاءالمبنى!');

        Building::create($request->validated());

        return $this->respondCreated();
    }

    public function update(UpdateBuildingRequest $request, Building $building)
    {
        abort_if(!auth()->user()->can('edit-building'), 403, 'ليس لديك الصلاحيات على التعديل!');

        $building->name = $request->name;
        $building->number = $request->number;
        $building->user_id = $request->user_id;
        $building->status = $request->status;
        $building->notes = $request->notes;
        $building->period_id = $request->period_id;
        $building->checked_at = null;

        if ($request->status == 1) {
            if ($request->period_id == 1) {
                $building['checked_at'] = Carbon::now()->addMonth();
            } elseif ($request->period_id == 2) {
                $building['checked_at'] = Carbon::now()->addDays('90');
            } elseif ($request->period_id == 3) {
                $building['checked_at'] = Carbon::now()->addDays('180');
            } elseif ($request->period_id == 4) {
                $building['checked_at'] = Carbon::now()->addYear();
            } else {
                $building['checked_at'] = null;
            }
        }

        $building->update();
    }

    public function destroy(Building $building)
    {
        abort_if(!auth()->user()->can('delete-building'), 403, 'ليس لديك الصلاحيات على حذف المبنى!');

        $building->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function quickUpdate(QuickUpdateBuildingRequest $request, Building $building)
    {
        $this->authorize('update', $building);

        $building->status = $request->status;
        $building->notes = $request->notes;
        $building->period_id = $request->period_id;
//        $building->checked_at = null;

        if ($request->status == 1) {
            if ($request->period_id == Building::ONE_MONTH) {
                $building['checked_at'] = Carbon::now()->addMonth();
            } elseif ($request->period_id == Building::THREE_MONTHS) {
                $building['checked_at'] = Carbon::now()->addDays('90');
            } elseif ($request->period_id == Building::SIX_MONTHS) {
                $building['checked_at'] = Carbon::now()->addDays('180');
            } elseif ($request->period_id == Building::YEAR) {
                $building['checked_at'] = Carbon::now()->addYear();
            } else {
                $building['checked_at'] = null;
            }
        }

        $building->update();
    }

    public function buildingList()
    {
        $buildings = Building::select(['id', 'name', 'notes'])->get();

        return $this->respond([
            'buildings' => $buildings
        ]);
    }
}
