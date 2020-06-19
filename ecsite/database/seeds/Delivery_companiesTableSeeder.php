<?php

use Illuminate\Database\Seeder;

class Delivery_companiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_companies')->insert([
            [
                'name' => 'ヤマト運輸',
                'telephone' => '00000000000',
                'shipping_cost' => '1000',
            ],
            [
                'name' => '佐川急便',
                'telephone' => '11111111111',
                'shipping_cost' => '2000',
            ],
        ]);
    }
}
