<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Exception;

class InventoryService
{
    /**
     * Stock IN (Purchase / Opening stock)
     */
    public function stockIn(
        int $warehouseId,
        int $productId,
        int $quantity,
        ?string $referenceType = null,
        ?int $referenceId = null,
        ?string $remarks = null
    ) {
        DB::transaction(function () use (
            $warehouseId,
            $productId,
            $quantity,
            $referenceType,
            $referenceId,
            $remarks
        ) {

            // create transaction
            StockTransaction::create([
                'warehouse_id'   => $warehouseId,
                'product_id'     => $productId,
                'type'           => 'in',
                'quantity'       => $quantity,
                'reference_type' => $referenceType,
                'reference_id'   => $referenceId,
                'remarks'        => $remarks,
            ]);

            // update or create stock
            Stock::updateOrCreate(
                [
                    'warehouse_id' => $warehouseId,
                    'product_id'   => $productId,
                ],
                [
                    'quantity' => DB::raw("quantity + $quantity"),
                ]
            );
        });
    }

    /**
     * Stock OUT (Sale / Issue)
     */
    public function stockOut(
        int $warehouseId,
        int $productId,
        int $quantity,
        ?string $referenceType = null,
        ?int $referenceId = null,
        ?string $remarks = null
    ) {
        DB::transaction(function () use (
            $warehouseId,
            $productId,
            $quantity,
            $referenceType,
            $referenceId,
            $remarks
        ) {

            $stock = Stock::where([
                'warehouse_id' => $warehouseId,
                'product_id'   => $productId,
            ])->first();

            if (!$stock || $stock->quantity < $quantity) {
                throw new Exception('Insufficient stock');
            }

            StockTransaction::create([
                'warehouse_id'   => $warehouseId,
                'product_id'     => $productId,
                'type'           => 'out',
                'quantity'       => $quantity,
                'reference_type' => $referenceType,
                'reference_id'   => $referenceId,
                'remarks'        => $remarks,
            ]);

            $stock->decrement('quantity', $quantity);
        });
    }
}
