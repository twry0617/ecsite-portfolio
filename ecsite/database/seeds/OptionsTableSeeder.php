<?php

use Illuminate\Database\Seeder;
use App\Enums\OptionSize;
use App\Enums\OptionColor;
use Carbon\Carbon;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 現在時刻を取得
        $now = Carbon::now();

        DB::table('options')->insert([
            [
                'product_id' => 1,
                'size'       => OptionSize::NONE,
                'color'      => OptionColor::WHITE,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 1,
                'size'       => OptionSize::NONE,
                'color'      => OptionColor::BLACK,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 2,
                'size'       => OptionSize::S,
                'color'      => OptionColor::BLACK,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
