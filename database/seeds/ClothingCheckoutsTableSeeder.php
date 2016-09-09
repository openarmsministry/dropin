<?php

use Illuminate\Database\Seeder;

class ClothingCheckoutsTableSeeder extends Seeder
{
    static $seedCount = 800;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ClothingCheckout::class)->times(static::$seedCount)->make()->each(function (App\ClothingCheckout $checkout) {
            if(
                \DB::table('clothing_checkouts')->where('attendance_id', $checkout->attendance_id)->exists() or
                ! \DB::table('attendances')->where('id', $checkout->attendance_id)->exists()
            ) {
                return;
            }
            $checkout->save();

            $randomTypeIds = array_filter(range(1,7), function () {
                return rand(1, 10) > 6;
            });

            foreach($randomTypeIds as $typeId) {
                $checkout->clothingTypes()->attach($typeId, ['amount' => random_int(1, 5)]);
            }
        });
    }
}
