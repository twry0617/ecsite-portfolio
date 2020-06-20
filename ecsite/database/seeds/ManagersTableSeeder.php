<?php

use Illuminate\Database\Seeder;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managers')->insert([
            'name'              => 'managers',
            'email'             => 'managers@example.com',
            'password'          => Hash::make('test1234'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
