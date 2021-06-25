<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RoleResource;
use App\Models\Role;

class RoleController extends ApiController
{
    public function getRoles()
    {
        $roles = Role::select('id', 'role')->get();

        return $this->respond([
            'roles' => RoleResource::collection($roles)
        ]);
    }
}
