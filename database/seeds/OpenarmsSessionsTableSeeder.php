<?php

use Illuminate\Database\Seeder;

class OpenarmsSessionsTableSeeder extends Seeder
{
    static $seedCount = 20;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('openarms_sessions')->truncate();
        factory(App\OpenarmsSession::class, static::$seedCount)->create();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
