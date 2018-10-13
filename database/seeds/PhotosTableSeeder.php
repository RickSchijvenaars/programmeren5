<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'name' => str_random(10),
            'description' => str_random(1000),
            'user_id' => 1,
            'category' => 'Cars',
        ]);
    }
}
