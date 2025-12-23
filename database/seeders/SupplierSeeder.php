<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            [
                'name' => 'ABC Supplier',
                'code' => 'SUP-001',
                'city' => 'Bangalore',
            ],
            [
                'name' => 'XYZ Distributors',
                'code' => 'SUP-002',
                'city' => 'Pune',
            ],
        ]);

        Supplier::factory()->count(20)->create();
    }
}
