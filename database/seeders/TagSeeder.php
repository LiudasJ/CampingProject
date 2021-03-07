<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'Wifi',
        ]);
        DB::table('tags')->insert([
            'name' => 'Pool',
        ]);
        DB::table('tags')->insert([
            'name' => 'Parking',
        ]);
    }
}
