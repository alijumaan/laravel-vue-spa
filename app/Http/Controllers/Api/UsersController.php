<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Notifications\UserInviteNotification;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class UsersController extends ApiController
{
    public function index()
    {
        $user = new User();
//        $users = $user->where('id', '<>', 1)->get();
        $users = $user->all();
        $usersCount = $user->where('deleted_at', null)->get()->count();

        $unActiveUsers = $user->onlyTrashed()->get();
        $unActiveUserCount = $user->onlyTrashed()->get()->count();

        return [
            'users' => UsersResource::collection($users),
            'unActiveUsers' => $unActiveUsers,
            'usersCount' => $usersCount,
            'unActiveUsersCount' => $unActiveUserCount
        ];
    }

    public function store(StoreUserRequest $request)
    {
        abort_if(!auth()->user()->can('add-user'), 403, 'ليس لديك الصلاحيات على استعادة المستخدمين!');

        $this->authorize('create', User::class);

        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['role_id'] = 3;

        $user = User::create($data);

        $url = URL::signedRoute('invitation', $user);

        $user->notify(new UserInviteNotification($url));
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);

        return [
            "user" => $user
        ];
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(!auth()->user()->can('edit-user'), 403, 'ليس لديك الصلاحيات على تعديل المستخدمين!');

        $user->update($request->validated() + ['role_id' => $request->role_id]);
    }

    public function destroy(User $user)
    {
        abort_if(!auth()->user()->can('delete-user'), 403, 'ليس لديك الصلاحيات على حذف المستخدمين!');

        if ($user->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
    }

    public function restore($id)
    {
        abort_if(!auth()->user()->can('restore-user'), 403, 'ليس لديك الصلاحيات على استعادة المستخدمين!');

        User::withTrashed()->find($id)->restore();
    }

    public function forceDelete($id)
    {
        abort_if(!auth()->user()->can('force-delete-user'), 403, 'ليس لديك الصلاحيات على حذف المستخدمين نهائياً!');

        $user = User::withTrashed()->findOrFail($id);

        $user->forceDelete();

//        return response()->json(null, Response::HTTP_NO_CONTENT);
        return response()->noContent();
    }
}
