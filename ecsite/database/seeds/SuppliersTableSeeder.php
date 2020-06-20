<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'name'              => 'suppliers',
            'email'             => 'suppliers@example.com',
            'password'          => Hash::make('test1234'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
