<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Angga Ari Wijaya',
                'email' => 'anggadarkprince@gmail.com',
                'password' => bcrypt('admin1234'),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'sketchprojectstudio@gmail.com',
                'password' => bcrypt('su1234'),
            ]
        ]);
    }
}
