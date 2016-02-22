<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' => 'Website Name',
                'value' => 'Info Gue',
            ],
            [
                'key' => 'Keywords',
                'value' => 'news, trending, headline, article, post, blog, entertainment, technology, music, film, celebrities',
            ],
            [
                'key' => 'Status',
                'value' => 'online',
            ],
            [
                'key' => 'Address',
                'value' => 'Avenue Street 23, Indonesia',
            ],
            [
                'key' => 'Contact',
                'value' => '+6285655479868',
            ],
            [
                'key' => 'Email',
                'value' => 'editor@infogue.id',
            ],
            [
                'key' => 'Description',
                'value' => 'The most update web portal news. We always provide latest article and information with high integrity and truth. Knowledge is beyond among us to share with you.',
            ],
            [
                'key' => 'Owner',
                'value' => 'Angga Ari Wijaya',
            ],
            [
                'key' => 'Latitude',
                'value' => '0.56347435',
            ],
            [
                'key' => 'Longitude',
                'value' => '0.47473563',
            ],
            [
                'key' => 'Facebook',
                'value' => 'https://www.facebook.com/pages/infogue',
            ],
            [
                'key' => 'Twitter',
                'value' => 'https://www.twitter.com/infogue',
            ],
            [
                'key' => 'Google Plus',
                'value' => 'https://plus.google.com/+InfoGue',
            ],
            [
                'key' => 'Favicon',
                'value' => 'favicon.ico',
            ],
            [
                'key' => 'Background',
                'value' => '',
            ],
            [
                'key' => 'Email Article',
                'value' => '1',
            ],
            [
                'key' => 'Email Feedback',
                'value' => '1',
            ],
            [
                'key' => 'Email Contributor',
                'value' => '1',
            ],
            [
                'key' => 'Auto Approve',
                'value' => '1',
            ],
        ]);
    }
}
