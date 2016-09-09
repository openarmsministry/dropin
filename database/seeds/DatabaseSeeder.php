<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(OpenarmsSessionsTableSeeder::class);
        $this->call(GuestsTableSeeder::class);
        $this->call(AttendancesTableSeeder::class);
        $this->call(ClothingTypesTableSeeder::class);
        $this->call(ClothingCheckoutsTableSeeder::class);
    }
}
