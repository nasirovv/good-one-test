<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warehouses')->insert([
            'material_id' => 1,
            'amount' => 12,
            'price' => '1500'
        ]);

        DB::table('warehouses')->insert([
            'material_id' => 1,
            'amount' => 200,
            'price' => '1600'
        ]);

        DB::table('warehouses')->insert([
            'material_id' => 2,
            'amount' => 40,
            'price' => '500'
        ]);

        DB::table('warehouses')->insert([
            'material_id' => 2,
            'amount' => 300,
            'price' => '550'
        ]);

        DB::table('warehouses')->insert([
            'material_id' => 3,
            'amount' => 500,
            'price' => '300'
        ]);

        DB::table('warehouses')->insert([
            'material_id' => 4,
            'amount' => 1000,
            'price' => '2000'
        ]);

    }
}
