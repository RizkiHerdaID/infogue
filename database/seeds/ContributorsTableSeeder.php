<?php

use Illuminate\Database\Seeder;

class ContributorsTableSeeder extends Seeder
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
                'token' => uniqid(),
                'vendor' => 'web',
                'name' => 'Administrator',
                'username' => 'support',
                'email' => 'support@infogue.id',
                'password' => 'admin1234',
                'status' => 'activated',
                'gender' => 'male',
                'avatar' => 'noavatar.jpg',
                'cover' => 'nocover.jpg',
                'birthday' => '2016-01-01',
                'about' => 'Default Infogue.id support team and administrator',
                'location' => 'Jakarta, Indonesia',
                'contact' => '(000) 000-000',
                'facebook' => 'https://www.facebook.com/infogue',
                'twitter' => 'https://www.twitter.com/infogue',
                'googleplus' => 'https://plus.google.com/+Infogue',
                'instagram' => 'https://www.instagram.com/infogue',
                'mobile_notification' => 0,
                'email_subscription' => 0,
                'email_message' => 0,
                'email_follow' => 0,
                'email_feed' => 0,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'token' => uniqid(),
                'vendor' => 'web',
                'name' => 'Angga Ari Wijaya',
                'username' => 'anggadarkprince',
                'email' => 'anggadarkprince@gmail.com',
                'password' => 'Angga17kireina',
                'status' => 'activated',
                'gender' => 'male',
                'avatar' => 'admin_1.jpg',
                'cover' => 'nocover.jpg',
                'birthday' => '1992-05-26',
                'about' => 'Default Infogue.id developer team and administrator',
                'location' => 'Gresik, Indonesia',
                'contact' => '+6285655479868',
                'facebook' => 'https://www.facebook.com/anggadarkprince',
                'twitter' => 'https://www.twitter.com/anggadarkprince',
                'googleplus' => 'https://plus.google.com/+AnggaAriWijaya',
                'instagram' => 'https://www.instagram.com/anggadarkprince',
                'mobile_notification' => 0,
                'email_subscription' => 0,
                'email_message' => 0,
                'email_follow' => 0,
                'email_feed' => 0,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'token' => uniqid(),
                'vendor' => 'web',
                'name' => 'Sketch Project Studio',
                'username' => 'sketchproject',
                'email' => 'sketchprojectstudio@gmail.com',
                'password' => 'Angga17kireina',
                'status' => 'activated',
                'gender' => 'male',
                'avatar' => 'admin_2.jpg',
                'cover' => 'nocover.jpg',
                'birthday' => '1992-05-26',
                'about' => 'Default Infogue.id developer team and administrator',
                'location' => 'Gresik, Indonesia',
                'contact' => '+6285655479868',
                'facebook' => 'https://www.facebook.com/sketchproject',
                'twitter' => 'https://www.twitter.com/sketchproject',
                'googleplus' => 'https://plus.google.com/+SketchProject',
                'instagram' => 'https://www.instagram.com/sketchproject',
                'mobile_notification' => 0,
                'email_subscription' => 0,
                'email_message' => 0,
                'email_follow' => 0,
                'email_feed' => 0,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ]);

        factory(Infogue\Contributor::class, 100)->create();
    }
}
