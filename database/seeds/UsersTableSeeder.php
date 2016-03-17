<?php

use Carbon\Carbon;
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
                'name' => 'Infogue Support',
                'email' => 'support@infogue.id',
                'password' => bcrypt('admin1234'),
                'avatar' => 'admin_1.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Angga Ari Wijaya',
                'email' => 'anggadarkprince@gmail.com',
                'password' => bcrypt('admin1234'),
                'avatar' => 'admin_1.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'sketchprojectstudio@gmail.com',
                'password' => bcrypt('su1234'),
                'avatar' => 'admin_2.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ]);
    }
}
