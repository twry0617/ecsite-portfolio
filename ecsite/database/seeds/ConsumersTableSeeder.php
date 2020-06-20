<?php

use Illuminate\Database\Seeder;

class ConsumersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consumers')->insert([
            'name'              => 'consumers',
            'email'             => 'consumers@example.com',
            'password'          => Hash::make('test1234'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
