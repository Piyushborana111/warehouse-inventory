<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::where('slug', 'laptops')->first();
        $supplier = Supplier::first();

        Product::insert([
            [
                'name' => 'Dell Inspiron',
                'sku' => 'LAP-001',
                'category_id' => $category->id,
                'supplier_id' => $supplier->id,
                'purchase_price' => 45000,
                'selling_price' => 55000,
            ],
            [
                'name' => 'HP Pavilion',
                'sku' => 'LAP-002',
                'category_id' => $category->id,
                'supplier_id' => $supplier->id,
                'purchase_price' => 48000,
                'selling_price' => 60000,
            ],
        ]);
        Product::factory()->count(30)->create();
    }
}
