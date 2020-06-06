<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ConsumersTableSeeder::class,
            ManagersTableSeeder::class,
            CategoriesTableSeeder::class,
            Delivery_companiesTableSeeder::class,

            ]);
    }
}
