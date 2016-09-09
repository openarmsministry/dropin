<?php

use Illuminate\Database\Seeder;

class AttendancesTableSeeder extends Seeder
{
    static $seedCount = 1000;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('attendances')->truncate();
        factory(App\Attendance::class, static::$seedCount)->make()->each(function (App\Attendance $attendance) {
            $guestId = random_int(1, GuestsTableSeeder::$seedCount);
            if (DB::table('attendances')->where('guest_id', $guestId)->where('openarms_session_id', $attendance->openarms_session_id)->exists()) {
                return;
            }
            $attendance->guest_id = $guestId;
            $attendance->save();
        });
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
