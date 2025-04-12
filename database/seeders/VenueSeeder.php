<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venues')->insert([
            [
                'name' => 'Grand Hall',
                'description' => 'A spacious venue suitable for large events and gatherings.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Conference Center',
                'description' => 'Perfect for business meetings, conferences, and workshops.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outdoor Arena',
                'description' => 'An open-air venue ideal for concerts and sports events.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
