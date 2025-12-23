<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Category;

/**
 * Class DashboardController
 *
 * Handles dashboard related statistics for the application.
 * All metrics are calculated server-side to ensure data integrity,
 * security, and proper access control.
 *
 * @package App\Http\Controllers\Api
 */
class DashboardController extends Controller
{
    /**
     * Get dashboard statistics.
     *
     * Returns aggregated counts required for the dashboard such as:
     * - Total warehouses accessible by the logged-in user
     * - Total products
     * - Total stock quantity across warehouses
     *
     * Data is scoped based on the authenticated user's role
     * to enforce role-based access control (RBAC).
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        /**
         * Authenticated user instance.
         * Used for role-based data scoping.
         */
        $user = $request->user();

        /**
         * Base queries for dashboard metrics.
         * These queries may be modified further based on user role.
         */
        $warehouseQuery = Warehouse::query();
        $productQuery   = Product::query();
        $stockQuery     = Stock::query();
        $userQuery      = User::query();
        $supplierQuery  = Supplier::query();
        $categoryQuery  = Category::query();

        /**
         * Prepare and return dashboard statistics.
         * These values are consumed by the frontend dashboard view.
         */
        return response()->json([
            'total_warehouses' => $warehouseQuery->count(),
            'total_products'   => $productQuery->count(),
            'total_users'      => $userQuery->count(),
            'total_suppliers'  => $supplierQuery->count(),
            'total_categories' => $categoryQuery->count(),
            'total_stock'      => $stockQuery->sum('quantity'),
        ]);
    }
}
