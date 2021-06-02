<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Notifications\UserInviteNotification;
use Illuminate\Support\Facades\URL;

class UserController extends ApiController
{
    public function index(User $user)
    {
        if (auth()->user()->isAdmin()) {
            $users = $user->where('id', '<>', 1)->get();
        } else {
            $users = $user
                ->where('id', auth()->id())
                ->get();
        }

        $usersCount = $user->where('id', '<>', 1)->get()->count();

        $unActiveUsers = $user->onlyTrashed()->get();

        $unActiveUserCount = $user->onlyTrashed()->get()->count();

        return $this->respond([
            'users' => UsersResource::collection($users),
            'unActiveUsers' => $unActiveUsers,
            'usersCount' => $usersCount,
            'unActiveUsersCount' => $unActiveUserCount
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('add-user');

        $user = User::create($request->validated());

        $user->profile()->create([
            'user_id' => $user->id,
            'bio' => NULL
        ]);

        $url = URL::signedRoute('invitation', $user);

        $user->notify(new UserInviteNotification($url));
    }

    public function show(User $user)
    {
        return $this->respond([
            "user" => $user
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('edit-user');

        $user->update($request->validated() + ['role_id' => $request->role_id]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete-user');

        $user->delete();

        return $this->respond([
            'message' => 'تم الحذف وبامكانك استرجاعه أيضاً'
        ]);
    }

    public function restore($id)
    {
        $this->authorize('restore-user');

        User::withTrashed()->find($id)->restore();
    }

    public function forceDelete($id)
    {
        $this->authorize('force-delete-user');

        $user = User::withTrashed()->findOrFail($id);

        $user->forceDelete();

        return $this->respondNoContent();
    }
}
