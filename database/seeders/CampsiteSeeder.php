<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CampsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campsites')->insert([
            'name' => 'proAlpha Campsite',
            'country' => 'Germany',
            'city' => 'Berlin',
            'website' => 'proalpha.de',
            'rating' => 5,
            'img_path' => '../images/camping.jpg'
        ]);
    }
}
