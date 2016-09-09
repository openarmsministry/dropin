<?php

use Illuminate\Database\Seeder;

class ClothingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('clothing_types')->truncate();
        \DB::table('clothing_types')->insert([
            ['name' => 'Jeans'],
            ['name' => 'T-shirts'],
            ['name' => 'shirts'],
            ['name' => 'Khakis'],
            ['name' => 'Coats'],
            ['name' => 'Jackets'],
            ['name' => 'Socks']
        ]);
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
