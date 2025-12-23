<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Http\Requests\StoreStockTransactionRequest;
use App\Http\Requests\UpdateStockTransactionRequest;

class StockTransactionController extends Controller
{
    /**
     * Display a listing of stock Transaction.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {   
        // 1. Fetch all stock transactions (latest first)
        $transactions = StockTransaction::orderBy('id', 'desc')->get();

        // 2. Return response
        return response()->json($transactions);
    }

    /**
     * Store a newly created stock Transaction in database.
     *
     * @param  \App\Http\Requests\StoreStockTransactionRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStockTransactionRequest $request)
    {     
        // 1. Validate request data
         $validated = $request->validated();

        // 2. Create new product
        $product = StockTransaction::create($validated);

        // 3. Return created category
        return response()->json($product, 201);
    }

    /**
     * Display the specified stock transaction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        // 1. Find transaction by ID
        $transaction = StockTransaction::find($id);

        // 2. If not found return error
        if (!$transaction) {
            return response()->json(['message' => 'Stock transaction not found'], 404);
        }

        // 3. Return transaction
        return response()->json($transaction);
    }

     /**
     * Update the specified stock transaction in database.
     *
     * @param  \App\Http\Requests\UpdateStockTransactionRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStockTransactionRequest $request, string $id)
    {
        // 1. Find transaction
        $transaction = StockTransaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Stock transaction not found'], 404);
        }

        // 2. Validate request data
        $validated = $request->validated();

        // 3. Update transaction
        $transaction->update($validated);

        // 4. Return updated transaction
        return response()->json($transaction);
    }

    /**
     * Remove the specified stock transaction from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
         // 1. Find transaction
        $transaction = StockTransaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Stock transaction not found'], 404);
        }

        // 2. Delete transaction
        $transaction->delete();

        // 3. Return success message
        return response()->json(['message' => 'Stock transaction deleted successfully']);
    }
}
