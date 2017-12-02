<?php

use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slideshow_images')->insertGetId([
            'filename_en' => 'slider1-1.jpg',
            'online' => true,
            'type' => '0'
        ]);

        DB::table('slideshow_images')->insertGetId([
            'filename_en' => 'slider2-2.jpg',
            'online' => true,
            'type' => '0'
        ]);

        DB::table('slideshow_images')->insertGetId([
            'filename_en' => 'slider3-3.jpg',
            'online' => true,
            'type' => '0'
        ]);
    }
}
