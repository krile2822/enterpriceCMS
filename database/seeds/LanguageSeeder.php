<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{

  public function __construct() {
  }

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('languages')->insert([
              'code' => 'en',
              'name' => 'English',
              'locale' => 'EN',
              'status' => 'active',
              'default' => 1,
              'position' => '1'
          ]);
    DB::table('languages')->insert([
              'code' => 'hu',
              'name' => 'Hungarian',
              'locale' => 'HU',
              'status' => 'passive',
              'default' => 0,
              'position' => '2'
          ]);
      DB::table('languages')->insert([
                'code' => 'sr',
                'name' => 'Serbian',
                'locale' => 'SR',
                'status' => 'passive',
                'default' => 0,
                'position' => '3'
            ]);
  }


}
