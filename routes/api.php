<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ExtinguisherController;
use App\Http\Controllers\Api\InvitationController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\PeriodController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PermissionRoleController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], function() {

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('links/get-url', [LinkController::class, 'getUrl']);
        Route::apiResource('links', LinkController::class);

        Route::get('buildings/list', [BuildingController::class, 'buildingList']);
        Route::put('buildings/{building}/quickUpdate', [BuildingController::class, 'quickUpdate']);
        Route::apiResource('buildings', BuildingController::class );

        Route::delete('extinguishers/{extinguisherId}/{buildingId}', [ExtinguisherController::class, 'restore']);
        Route::get('extinguishers/type', [ExtinguisherController::class, 'getExtinguishersType']);
        Route::apiResource('extinguishers', ExtinguisherController::class );

        Route::apiResource('pages', PageController::class );

        Route::post('logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);

        /* Current User */
        Route::get('user/details', [UserController::class, 'details']);
        Route::get('user/setting', [UserController::class, 'details']);
        Route::post('user/update/avatar', [UserController::class, 'updateAvatar']);
        Route::post('user/update/profile', [UserController::class, 'updateProfile']);
        Route::post('user/update/password', [UserController::class, 'updatePassword']);

        /* Other Users */
        Route::post('users/{id}/restore',         [UsersController::class, 'restore']);
        Route::delete("users/{id}/forceDelete",   [UsersController::class, 'forceDelete']);
        Route::apiResource('users', UsersController::class);

        Route::get('roles', [RoleController::class, 'getRoles']);

        Route::apiResource('permissions', PermissionController::class);

        Route::post('permission-role', [PermissionRoleController::class, 'store']);
        Route::post('permission-role/{roleId}', [PermissionRoleController::class, 'getPermissionByRole']);


        Route::get('periods', [PeriodController::class, 'getPeriods']);

        /* Check if user is admin and logged in*/
        Route::get('/admin', function () {
            if (!auth()->user()->isAdmin()) {
                return false;
            }
            return true;
        });
        /* Check if user is supervisor or admin and logged in*/
        Route::get('/supervisor', function () {
            if (!auth()->user()->isSupervisor()) {
                return false;
            }
            return true;
        });

    });

    Route::get('invitation/{user}', [InvitationController::class, 'invitation'])->name('invitation');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::apiResource('contacts',ContactController::class)->except(['update']);
});
