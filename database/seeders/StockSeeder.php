<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Warehouse;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $warehouses = Warehouse::all();
        $products   = Product::all();

        foreach ($warehouses as $warehouse) {
            foreach ($products->random(10) as $product) {
                Stock::create([
                    'warehouse_id' => $warehouse->id,
                    'product_id'   => $product->id,
                    'quantity'     => rand(10, 300),
                ]);
            }
        }
    }
}
