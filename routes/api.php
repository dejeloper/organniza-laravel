<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
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

function softDeleteRoutes($prefix, $controller)
{
    Route::get("$prefix/withTrashed", [$controller, 'indexWithTrashed']);
    Route::get("$prefix/onlyTrashed", [$controller, 'indexOnlyTrashed']);
    Route::get("$prefix/{id}/trashed", [$controller, 'showTrashed']);
    Route::patch("$prefix/{id}/restore", [$controller, 'restore']);
    Route::delete("$prefix/{id}/forceDelete", [$controller, 'forceDelete']);
}

Route::prefix('api')->group(function () {
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
