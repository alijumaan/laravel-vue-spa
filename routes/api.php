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
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], function() {

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);

        /* Current User */
        Route::get('user/details', [ProfileController::class, 'details']);
        Route::get('user/setting', [ProfileController::class, 'details']);
        Route::post('user/update/avatar', [ProfileController::class, 'updateAvatar']);
        Route::post('user/update/profile', [ProfileController::class, 'updateProfile']);
        Route::post('user/update/password', [ProfileController::class, 'updatePassword']);

        /* Other Users */
        Route::post('users/{id}/restore',         [UserController::class, 'restore']);
        Route::delete("users/{id}/forceDelete",   [UserController::class, 'forceDelete']);
        Route::apiResource('users', UserController::class);

        Route::get('roles', [RoleController::class, 'getRoles']);

        Route::apiResource('permissions', PermissionController::class);

        Route::post('permission-role', [PermissionRoleController::class, 'store']);
        Route::post('permission-role/{roleId}', [PermissionRoleController::class, 'getPermissionByRole']);

        Route::get('/admin', function () {
            if (!auth()->user()->isAdmin()) {
                return false;
            }
            return true;
        });

        Route::get('/supervisor', function () {
            if (!auth()->user()->isSupervisor()) {
                return false;
            }
            return true;
        });

    });

    Route::get('links/get-url', [LinkController::class, 'getUrl']);
    Route::apiResource('links', LinkController::class);

    Route::get('periods', [PeriodController::class, 'getPeriods']);

    Route::get('buildings_list', [BuildingController::class, 'list']);
    Route::put('buildings/{building}/quickUpdate', [BuildingController::class, 'quickUpdate']);
    Route::apiResource('buildings', BuildingController::class );

    Route::delete('extinguishers/{extinguisherId}/{buildingId}', [ExtinguisherController::class, 'delete']);
    Route::get('extinguishers/type', [ExtinguisherController::class, 'getExtinguishersType']);
    Route::apiResource('extinguishers', ExtinguisherController::class );

    Route::get('invitation/{user}', [InvitationController::class, 'invitation'])->name('invitation');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::apiResource('pages', PageController::class );
    Route::apiResource('contacts',ContactController::class)->except(['update']);
});
