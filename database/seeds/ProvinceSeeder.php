<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('provinces')->insert([
            ['name' => 'Barcelona', 'country_id' => 1],
            ['name' => 'Madrid', 'country_id' => 1],
            ['name' => 'Girona', 'country_id' => 1],
            ['name' => 'Sevilla', 'country_id' => 1],
            ['name' => 'Lisboa', 'country_id' => 2],
            ['name' => 'Porto', 'country_id' => 2]
        ]);
    }
}
