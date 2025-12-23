<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
     /**
     * Display a listing of suppliers.
     */
    public function index()
    {
        // 1. Fetch all suppliers
        $suppliers = Supplier::all();

        // 2. Return response
        return response()->json($suppliers);
    }

    /**
     * Store a newly created supplier.
     */
    public function store(Request $request)
    {
        // 1. Validate request data
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|unique:suppliers,email',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string',
            'status'        => 'required|in:active,inactive',
        ]);

        // 2. Create supplier
        $supplier = Supplier::create($validated);

        // 3. Return created supplier
        return response()->json($supplier, 201);
    }

    /**
     * Display the specified supplier.
     */
    public function show($id)
    {
        // 1. Find supplier by ID
        $supplier = Supplier::find($id);

        // 2. If not found return error
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // 3. Return supplier
        return response()->json($supplier);
    }

    /**
     * Update the specified supplier.
     */
    public function update(Request $request, $id)
    {
        // 1. Find supplier
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // 2. Validate request data
        $validated = $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'email'   => 'nullable|email|unique:suppliers,email,' . $supplier->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status'  => 'sometimes|required|in:active,inactive',
        ]);

        // 3. Update supplier
        $supplier->update($validated);

        // 4. Return updated supplier
        return response()->json($supplier);
    }

    /**
     * Remove the specified supplier.
     */
    public function destroy($id)
    {
        // 1. Find supplier
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // 2. Delete supplier
        $supplier->delete();

        // 3. Return success message
        return response()->json(['message' => 'Supplier deleted successfully']);
    }
}
