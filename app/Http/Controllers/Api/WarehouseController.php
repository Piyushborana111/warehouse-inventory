<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;

class WarehouseController extends Controller
{
    /**
     * Display a listing of warehouses.
     */
    public function index(Request $request)
    {
        // Fetch all warehouses
        $search  = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $warehouses = Warehouse::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%")
                      ->orWhere('city', 'like', "%{$search}%")
                      ->orWhere('country', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data'    => $warehouses, // pagination object
            'message' => 'warehouses fetched successfully'
        ], 200);
    }

    /**
     * Store a newly created warehouse.
     */
    public function store(StoreWarehouseRequest $request)
    {
        // 1. Validate request data
        $validated = $request->validated();

        // 2. Create warehouse
        $warehouse = Warehouse::create($validated);

        // 3. Return created warehouse
        return response()->json($warehouse, 201);
    }

    /**
     * Display the specified warehouse.
     */
    public function show($id)
    {
        // 1. Find warehouse by ID
        $warehouse = Warehouse::find($id);

        // 2. If not found return error
        if (!$warehouse) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }

        // 3. Return warehouse
        return response()->json($warehouse);
    }

    /**
     * Update the specified warehouse.
     */
    public function update(UpdateWarehouseRequest $request, $id)
    {
        // 1. Find warehouse
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }

        // 2. Validate request data
        $validated = $request->validated();

        // 3. Update warehouse
        $warehouse->update($validated);

        // 4. Return updated warehouse
        return response()->json($warehouse);
    }

    /**
     * Remove the specified warehouse.
     */
    public function destroy($id)
    {
     
        // 1. Find warehouse
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }

        // 2. Delete warehouse
        $warehouse->delete();

        // 3. Return success message
        return response()->json(['message' => 'Warehouse deleted successfully']);
    }
}
