<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;

class RoleController extends ApiController
{
    public function getRoles()
    {
        $roles = Role::all();

        return [
            'roles' => $roles
        ];
    }
}
