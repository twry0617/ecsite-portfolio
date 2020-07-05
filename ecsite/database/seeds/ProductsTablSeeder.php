<?php

use Illuminate\Database\Seeder;
use App\Enums\ProductStatus;
use Carbon\Carbon;

class ProductsTablSeeder extends Seeder
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

        DB::table('products')->insert([
            [
                'supplier_id' => 1,
                'name'        => '冷蔵庫',
                'code'        => Str::random(15),
                'description' => '大容量の冷蔵庫です。5人家族でも楽々利用できます。',
                'price'       => 59800,
                'stock'       => 4,
                'status'      => ProductStatus::ON_SALE,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'supplier_id' => 1,
                'name'        => 'リュック',
                'code'        => Str::random(15),
                'description' => '今流行のあのリュック。遠出する際や、ちょっとした外出用に最適です！',
                'price'       => 9800,
                'stock'       => 20,
                'status'      => ProductStatus::ON_SALE,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'supplier_id' => 1,
                'name'        => 'スマホケース',
                'code'        => Str::random(15),
                'description' => '誰ともかぶらない伝説のスマホケース爆誕!!周りの人と差をつけろ!!',
                'price'       => 4800,
                'stock'       => 10,
                'status'      => ProductStatus::ON_SALE,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
