<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        [
          'name' => 'ファッション',
          
        ],
        [
          'name' => 'コスメ',
          
        ],
        [
          'name' => '美容',
          
        ],
      ]);
    }
}