<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert([
            'name' => 'mato'
        ]);

        DB::table('materials')->insert([
            'name' => 'ip'
        ]);

        DB::table('materials')->insert([
            'name' => 'tugma'
        ]);

        DB::table('materials')->insert([
            'name' => 'zamok'
        ]);
    }
}
