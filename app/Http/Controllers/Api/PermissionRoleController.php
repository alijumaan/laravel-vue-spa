<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends ApiController
{
    public function store(Request $request)
    {
        Role::find($request->role_id)->permissions()->sync($request->permission);

        return $this->respondCreated();
    }

    public function getPermissionByRole($roleId)
    {
        $permissions = Role::find($roleId)->permissions()->pluck('permission_id');

        return $this->respond([
            'permissions' => $permissions
        ]);
    }
}
