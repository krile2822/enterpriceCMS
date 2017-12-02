<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
        DB::table('users')->insertGetId([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'confirmed' => '1',
            'is_admin' => '1',
            'password' => bcrypt('admin')
        ]);

        DB::table('users')->insertGetId([
            'name' => 'user',
            'email' => 'user@user.com',
            'confirmed' => '1',
            'is_admin' => '0',
            'password' => bcrypt('user')
        ]);
    }
}
