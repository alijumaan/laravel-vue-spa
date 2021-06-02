<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Models\Permission;
use App\Models\Role;

class PermissionController extends ApiController
{
    public function __construct()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            $this->authorize('view-permissions');
        }
    }

    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return $this->respond([
            'permissions' => PermissionResource::collection($permissions),
            'roles' => RoleResource::collection($roles)
        ]);
    }

    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->validated());

        return $this->respondCreated();
    }

}
