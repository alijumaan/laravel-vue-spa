<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserProfileResource;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends ApiController
{
    use ImageUploadTrait;

    public function details()
    {
        return $this->respond([
            "user" => new UserProfileResource(auth()->user())
        ]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'كلمة المرور الحالية غير صحيحة'
            ]);
        }

        auth()->user()->password = $request->new_password;

        if (auth()->user()->save()) {

            return $this->respondUpdated('Password updated successfully');

        } else {
            return $this->respondInternalError();
        }
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        auth()->user()->update($request->validated());

        auth()->user()->profile()->updateOrcreate([
            'user_id' => auth()->id()
        ], $request->only([
            'bio',
        ]));

        return $this->respondUpdated('Updated your profile successfully');
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        if ($request->hasFile('avatar')) {

            if (File::exists('storage/assets/avatars/' . auth()->user()->profile->avatar)) {
                unlink('storage/assets/avatars/' . auth()->user()->profile->avatar);
            }

            $avatar = $this->uploadAvatar($request->avatar);

            auth()->user()->profile()->update(['avatar' => $avatar]);

            return $this->respondUpdated('Updated your avatar successfully');
        }
    }

}
