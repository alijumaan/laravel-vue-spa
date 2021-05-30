<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    public function store(Request $request)
    {
        $data = Role::find($request->role_id)->permissions()->sync($request->permission);

        return [
            'data' => $data
        ];
    }

    public function getPermissionByRole($roleId)
    {
        $permissions = Role::find($roleId)->permissions()->pluck('permission_id');

        return [
            'permissions' => $permissions
        ];
    }
}
