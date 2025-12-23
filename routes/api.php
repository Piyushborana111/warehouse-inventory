<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    UserController,
    OrganizationController,
    WarehouseController,
    CategoryController,
    DashboardController,
    SupplierController,
    ProductController,
    StockController,
    StockTransactionController
};
Route::post('/login', [AuthController::class, 'login']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('warehouses', WarehouseController::class);
    Route::apiResource('products', ProductController::class); 
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('dashboard', DashboardController::class);
    Route::apiResource('organizations', OrganizationController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
 
    Route::post('/logout', [AuthController::class, 'logout']);

    // inventory APIs
  
    // stocks / stock transactions
    Route::get('stocks', [StockController::class, 'index']); // warehouse-wise stock listing
    Route::post('stock-in', [StockTransactionController::class, 'stockIn']);
    Route::post('stock-out', [StockTransactionController::class, 'stockOut']);
});
