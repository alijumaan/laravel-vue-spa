<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

class InvitationController extends ApiController
{
    public function invitation(User $user)
    {
        if (!request()->hasValidSignature()) {
            abort(401);
        }

        auth()->login($user);

        return redirect()->to('/login');
    }
}
