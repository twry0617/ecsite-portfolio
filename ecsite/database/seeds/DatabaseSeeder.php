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
            SuppliersTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            DeliveryCompaniesTableSeeder::class,
            ProductsTabldeSeeder::class,

        ]);
    }
}
