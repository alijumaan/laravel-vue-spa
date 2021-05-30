<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends ApiController
{
    use ImageUploadTrait;

    public function details()
    {
        $user = User::with(['profile', 'buildings'])->find(auth()->id());

        return ["user" => new UserProfileResource($user)];
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'كلمة المرور الحالية غير صحيحة'
            ]);
        }

        $user->password = bcrypt($request->new_password);

        if ($user->save()) {
            return [
                'message' => 'Password updated successfully'
            ];
        } else {
            return response()->json([
                'message' => 'Something was wrong please try again later'
            ], 500);
        }
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        auth()->user()->update($request->only(['name', 'email']));

        auth()->user()->profile()->updateOrcreate([
            'user_id' => auth()->id()
        ], $request->only([
            'bio',
        ]));

        return ['message' => 'Updated your profile successfully'];

    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        if ($request->hasFile('avatar')) {

            if (File::exists('storage/assets/avatars/' . auth()->user()->profile->avatar)) {
                unlink('storage/assets/avatars/' . auth()->user()->profile->avatar);
            }

            $avatar = $this->uploadAvatar($request->avatar);

            auth()->user()->profile()->update(['avatar' => $avatar]);

            return ['message' => 'Updated your avatar successfully'];
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
    }
}
