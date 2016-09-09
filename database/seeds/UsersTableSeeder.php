<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    static $seedCount = 5;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('users')->truncate();
        factory(App\User::class, static::$seedCount)->create();

        \DB::table('role_user')->truncate();
        \DB::table('role_user')->insert(['user_id' => 1, 'role_id' => 1]);
        \DB::table('role_user')->insert(['user_id' => 2, 'role_id' => 1]);

        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
