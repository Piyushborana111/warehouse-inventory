<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;

class StockController extends Controller
{
    /**
     * Display a listing of stock.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {   
        // 1. Get all stock records
        $stocks = Stock::all();

        // 2. Return response
        return response()->json($stocks);
    }

    /**
     * Store a newly created product in database.
     *
     * @param  \App\Http\Requests\StoreStockRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStockRequest $request)
    {     
        // 1. Validate request data
         $validated = $request->validated();

        // 2. Create new product
        $product = Stock::create($validated);

        // 3. Return created category
        return response()->json($product, 201);
    }

    /**
     * Display the specified stock.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
         // 1. Find stock entry by ID
        $stock = Stock::find($id);

        // 2. If not found return error
        if (!$stock) {
            return response()->json(['message' => 'Stock record not found'], 404);
        }

        // 3. Return stock record
        return response()->json($stock);
    }

     /**
     * Update the specified stock in database.
     *
     * @param  \App\Http\Requests\UpdateStockRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStockRequest $request, string $id)
    {
        // 1. Find stock record
        $stock = Stock::find($id);
        if (!$stock) {
            return response()->json(['message' => 'Stock record not found'], 404);
        }

        // 2. Validate request data
        $validated = $request->validated();

        // 3. Update stock record
        $stock->update($validated);

        // 4. Return updated stock record
        return response()->json($stock);
    }

    /**
     * Remove the specified stock from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
         // 1. Find stock record
        $stock = Stock::find($id);
        if (!$stock) {
            return response()->json(['message' => 'Stock record not found'], 404);
        }

        // 2. Delete stock record
        $stock->delete();

        // 3. Return success message
        return response()->json(['message' => 'Stock record deleted successfully']);
    }

}
