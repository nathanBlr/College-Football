<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stadium')->insert([
            [
                'name' => 'Michigan Stadium',
                'slug' => Str::slug('Michigan Stadium'),
                'full_name' => 'Michigan Stadium',
                'nickname' => 'The Big House',
                'photo' => '',
                'history' => 'Michigan Stadium, nicknamed "The Big House", is the football stadium for the University of Michigan in Ann Arbor, Michigan.',
                'capacity' => '107,601',
                'surface' => 'Turf',
                'year_built' => '1927',
                'location' => '1201 S Main St, Ann Arbor, MI 48104, United States',
                'country' => 'United States',
                'state' => 'Michigan',
                'city' => 'Ann Arbor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beaver Stadium',
                'slug' => Str::slug('Beaver Stadium'),
                'full_name' => 'Beaver Stadium',
                'nickname' => null,
                'photo' => '',
                'history' => 'Beaver Stadium is an outdoor college football stadium in University Park, Pennsylvania, on the campus of Pennsylvania State University.',
                'capacity' => '106,572',
                'surface' => 'Grass',
                'year_built' => '1960',
                'location' => '1 Beaver Stadium, University Park, PA 16802, United States',
                'country' => 'United States',
                'state' => 'Pennsylvania',
                'city' => 'University Park',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tiger Stadium',
                'slug' => Str::slug('Tiger Stadium'),
                'full_name' => 'Tiger Stadium',
                'nickname' => 'Death Valley',
                'photo' => '',
                'history' => 'Tiger Stadium, popularly known as "Death Valley", is an outdoor stadium located in Baton Rouge, Louisiana on the campus of Louisiana State University.',
                'capacity' => '102,321',
                'surface' => 'Grass',
                'year_built' => '1924',
                'location' => 'Baton Rouge, LA 70803, United States',
                'country' => 'United States',
                'state' => 'Louisiana',
                'city' => 'Baton Rouge',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kyle Field',
                'slug' => Str::slug('Kyle Field'),
                'full_name' => 'Kyle Field',
                'nickname' => null,
                'photo' => '',
                'history' => 'Kyle Field is the football stadium located on the campus of Texas A&M University in College Station, Texas.',
                'capacity' => '102,733',
                'surface' => 'Grass',
                'year_built' => '1927',
                'location' => '756 Houston St, College Station, TX 77843, United States',
                'country' => 'United States',
                'state' => 'Texas',
                'city' => 'College Station',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ohio Stadium',
                'slug' => Str::slug('Ohio Stadium'),
                'full_name' => 'Ohio Stadium',
                'nickname' => 'The Horseshoe',
                'photo' => '',
                'history' => 'Ohio Stadium, also known as "The Horseshoe" or "The Shoe", is an American football stadium in Columbus, Ohio, on the campus of The Ohio State University.',
                'capacity' => '102,780',
                'surface' => 'Turf',
                'year_built' => '1922',
                'location' => '411 Woody Hayes Dr, Columbus, OH 43210, United States',
                'country' => 'United States',
                'state' => 'Ohio',
                'city' => 'Columbus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
