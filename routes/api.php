<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CategoryController,
    ChecklistDetailController,
    ChecklistHeaderController,
    PlaceController,
    ProductController,
    ProductStatusController,
    PurchasesHistoryDetailController,
    PurchasesHistoryHeaderController,
    UnitController,
    UserController
};

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

function softDeleteRoutes($prefix, $controller)
{
    Route::get("$prefix/withTrashed", [$controller, 'indexWithTrashed']);
    Route::get("$prefix/onlyTrashed", [$controller, 'indexOnlyTrashed']);
    Route::get("$prefix/{id}/trashed", [$controller, 'showTrashed']);
    Route::patch("$prefix/{id}/restore", [$controller, 'restore']);
    Route::delete("$prefix/{id}/forceDelete", [$controller, 'forceDelete']);
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
