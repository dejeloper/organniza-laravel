<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CategoryController,
    ChecklistDetailController,
    ChecklistHeaderController,
    PermissionController,
    PlaceController,
    ProductController,
    ProductStatusController,
    PurchasesHistoryDetailController,
    PurchasesHistoryHeaderController,
    RoleController,
    UnitController,
    UserController,
    PermissionAssignmentController,
    RoleAssignmentController
};

// Autenticación
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Rutas de roles
Route::middleware(['auth:sanctum'])->prefix('roles')->group(function () {
    Route::apiResource('/', RoleController::class);
    Route::post('{roleId}/permissions', [PermissionAssignmentController::class, 'assignPermissionToRole']);
    Route::post('{roleId}/permissions/remove', [PermissionAssignmentController::class, 'removePermissionFromRole']);
    Route::get('{roleId}/permissions', [PermissionAssignmentController::class, 'getPermissionsOfRole']);
});

// Rutas de permisos
Route::middleware(['auth:sanctum'])->prefix('permissions')->group(function () {
    Route::apiResource('/', PermissionController::class);
});

// Rutas de usuarios y asignación de roles y permisos
Route::middleware(['auth:sanctum'])->prefix('users/{userId}')->group(function () {
    // Permisos
    Route::get('/permissions', [PermissionAssignmentController::class, 'getPermissionsOfUser']);
    Route::post('/permissions', [PermissionAssignmentController::class, 'assignPermissionToUser']);
    Route::post('/permissions/remove', [PermissionAssignmentController::class, 'removePermissionFromUser']);

    // Roles
    Route::get('/roles', [RoleAssignmentController::class, 'getRolesOfUser']);
    Route::post('/roles', [RoleAssignmentController::class, 'assignRolesToUser']);
    Route::post('/roles/remove', [RoleAssignmentController::class, 'removeRolesFromUser']);
});

function softDeleteRoutes($prefix, $controller)
{
    Route::prefix($prefix)->group(function () use ($controller) {
        Route::get('/withTrashed', [$controller, 'indexWithTrashed']);
        Route::get('/onlyTrashed', [$controller, 'indexOnlyTrashed']);
        Route::get('/{id}/trashed', [$controller, 'showTrashed']);
        Route::patch('/{id}/restore', [$controller, 'restore']);
        Route::delete('/{id}/forceDelete', [$controller, 'forceDelete']);
    });
}

Route::middleware('auth:sanctum')->group(function () {
    $resources = [
        'products' => ProductController::class,
        'categories' => CategoryController::class,
        'places' => PlaceController::class,
        'units' => UnitController::class,
        'checklistHeaders' => ChecklistHeaderController::class,
        'productStatuses' => ProductStatusController::class,
        'checklistDetails' => ChecklistDetailController::class,
        'purchasesHistoryHeaders' => PurchasesHistoryHeaderController::class,
        'purchasesHistoryDetails' => PurchasesHistoryDetailController::class,
        'users' => UserController::class,
    ];

    foreach ($resources as $route => $controller) {
        Route::apiResource($route, $controller);
        softDeleteRoutes($route, $controller);
    }
});
