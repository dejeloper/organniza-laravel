<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChecklistDetailController;
use App\Http\Controllers\ChecklistHeaderController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStatusController;
use App\Http\Controllers\PurchasesHistoryDetailController;
use App\Http\Controllers\PurchasesHistoryHeaderController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::get('productsWithTrashed', [ProductController::class, 'indexWithTrashed']);
Route::get('productsOnlyTrashed', [ProductController::class, 'indexOnlyTrashed']);
Route::get('products/{id}/trashed', [ProductController::class, 'showTrashed']);
Route::patch('products/{id}/restore', [ProductController::class, 'restore']);
Route::delete('products/{id}/forceDelete', [ProductController::class, 'forceDelete']);

Route::apiResource('categories', CategoryController::class);
Route::get('categoriesWithTrashed', [CategoryController::class, 'indexWithTrashed']);
Route::get('categoriesOnlyTrashed', [CategoryController::class, 'indexOnlyTrashed']);
Route::get('categories/{id}/trashed', [CategoryController::class, 'showTrashed']);
Route::patch('categories/{id}/restore', [CategoryController::class, 'restore']);
Route::delete('categories/{id}/forceDelete', [CategoryController::class, 'forceDelete']);

Route::apiResource('places', PlaceController::class);
Route::get('placesWithTrashed', [PlaceController::class, 'indexWithTrashed']);
Route::get('placesOnlyTrashed', [PlaceController::class, 'indexOnlyTrashed']);
Route::get('places/{id}/trashed', [PlaceController::class, 'showTrashed']);
Route::patch('places/{id}/restore', [PlaceController::class, 'restore']);
Route::delete('places/{id}/forceDelete', [PlaceController::class, 'forceDelete']);

Route::apiResource('units', UnitController::class);
Route::get('unitsWithTrashed', [UnitController::class, 'indexWithTrashed']);
Route::get('unitsOnlyTrashed', [UnitController::class, 'indexOnlyTrashed']);
Route::get('units/{id}/trashed', [UnitController::class, 'showTrashed']);
Route::patch('units/{id}/restore', [UnitController::class, 'restore']);
Route::delete('units/{id}/forceDelete', [UnitController::class, 'forceDelete']);

Route::apiResource('checklistHeaders', ChecklistHeaderController::class);
Route::get('checklistHeadersWithTrashed', [ChecklistHeaderController::class, 'indexWithTrashed']);
Route::get('checklistHeadersOnlyTrashed', [ChecklistHeaderController::class, 'indexOnlyTrashed']);
Route::get('checklistHeaders/{id}/trashed', [ChecklistHeaderController::class, 'showTrashed']);
Route::patch('checklistHeaders/{id}/restore', [ChecklistHeaderController::class, 'restore']);
Route::delete('checklistHeaders/{id}/forceDelete', [ChecklistHeaderController::class, 'forceDelete']);

Route::apiResource('products_statuses', ProductStatusController::class);
Route::get('products_statusesWithTrashed', [ProductStatusController::class, 'indexWithTrashed']);
Route::get('products_statusesOnlyTrashed', [ProductStatusController::class, 'indexOnlyTrashed']);
Route::get('products_statuses/{id}/trashed', [ProductStatusController::class, 'showTrashed']);
Route::patch('products_statuses/{id}/restore', [ProductStatusController::class, 'restore']);
Route::delete('products_statuses/{id}/forceDelete', [ProductStatusController::class, 'forceDelete']);

Route::apiResource('productStatuses', ProductStatusController::class);
Route::get('productStatusesWithTrashed', [ProductStatusController::class, 'indexWithTrashed']);
Route::get('productStatusesOnlyTrashed', [ProductStatusController::class, 'indexOnlyTrashed']);
Route::get('productStatuses/{id}/trashed', [ProductStatusController::class, 'showTrashed']);
Route::patch('productStatuses/{id}/restore', [ProductStatusController::class, 'restore']);
Route::delete('productStatuses/{id}/forceDelete', [ProductStatusController::class, 'forceDelete']);

Route::apiResource('checklistDetails', ChecklistDetailController::class);
Route::get('checklistDetailsWithTrashed', [ChecklistDetailController::class, 'indexWithTrashed']);
Route::get('checklistDetailsOnlyTrashed', [ChecklistDetailController::class, 'indexOnlyTrashed']);
Route::get('checklistDetails/{id}/trashed', [ChecklistDetailController::class, 'showTrashed']);
Route::patch('checklistDetails/{id}/restore', [ChecklistDetailController::class, 'restore']);
Route::delete('checklistDetails/{id}/forceDelete', [ChecklistDetailController::class, 'forceDelete']);

Route::apiResource('purchasesHistoryHeaders', PurchasesHistoryHeaderController::class);
Route::get('purchasesHistoryHeadersWithTrashed', [PurchasesHistoryHeaderController::class, 'indexWithTrashed']);
Route::get('purchasesHistoryHeadersOnlyTrashed', [PurchasesHistoryHeaderController::class, 'indexOnlyTrashed']);
Route::get('purchasesHistoryHeaders/{id}/trashed', [PurchasesHistoryHeaderController::class, 'showTrashed']);
Route::patch('purchasesHistoryHeaders/{id}/restore', [PurchasesHistoryHeaderController::class, 'restore']);
Route::delete('purchasesHistoryHeaders/{id}/forceDelete', [PurchasesHistoryHeaderController::class, 'forceDelete']);

Route::apiResource('purchasesHistoryDetails', PurchasesHistoryDetailController::class);
Route::get('purchasesHistoryDetailsWithTrashed', [PurchasesHistoryDetailController::class, 'indexWithTrashed']);
Route::get('purchasesHistoryDetailsOnlyTrashed', [PurchasesHistoryDetailController::class, 'indexOnlyTrashed']);
Route::get('purchasesHistoryDetails/{id}/trashed', [PurchasesHistoryDetailController::class, 'showTrashed']);
Route::patch('purchasesHistoryDetails/{id}/restore', [PurchasesHistoryDetailController::class, 'restore']);
Route::delete('purchasesHistoryDetails/{id}/forceDelete', [PurchasesHistoryDetailController::class, 'forceDelete']);
