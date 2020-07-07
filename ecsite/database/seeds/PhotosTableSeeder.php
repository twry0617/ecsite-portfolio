<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PhotosTableSeeder extends Seeder
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

        DB::table('photos')->insert([
            [
                'product_id' => 1,
                'photo'      => '../../public/image/no-image.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 1,
                'photo'      => '../../public/image/no-image.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 1,
                'photo'      => '../../public/image/no-image.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
