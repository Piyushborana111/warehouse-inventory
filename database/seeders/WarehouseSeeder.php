<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::insert([
            [
                'name' => 'Main Warehouse',
                'code' => 'WH-001',
                'city' => 'Mumbai',
                'is_active' => true,
            ],
            [
                'name' => 'Secondary Warehouse',
                'code' => 'WH-002',
                'city' => 'Delhi',
                'is_active' => true,
            ],
        ]);

        Warehouse::factory()->count(20)->create();
    }
}
