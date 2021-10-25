<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('material_product')->insert([
           'material_id' => 1,
           'product_id' => 1,
           'quantity' => 0.8
        ]);

        DB::table('material_product')->insert([
            'material_id' => 2,
            'product_id' => 1,
            'quantity' => 10
        ]);

        DB::table('material_product')->insert([
            'material_id' => 3,
            'product_id' => 1,
            'quantity' => 5
        ]);

        DB::table('material_product')->insert([
            'material_id' => 1,
            'product_id' => 2,
            'quantity' => 1.4
        ]);

        DB::table('material_product')->insert([
            'material_id' => 2,
            'product_id' => 2,
            'quantity' => 15
        ]);

        DB::table('material_product')->insert([
            'material_id' => 4,
            'product_id' => 2,
            'quantity' => 1
        ]);
    }
}
