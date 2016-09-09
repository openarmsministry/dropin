<?php

use Illuminate\Database\Seeder;

class GuestsTableSeeder extends Seeder
{
    static $seedCount = 100;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('guests')->truncate();
        factory(App\Guest::class, static::$seedCount)->create();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
