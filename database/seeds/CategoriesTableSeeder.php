<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category' => 'News',
                'description' => 'News Category'
            ],
            [
                'category' => 'Economic',
                'description' => 'Economic Category'
            ],
            [
                'category' => 'Entertainment',
                'description' => 'Entertainment Category'
            ],
            [
                'category' => 'Sport',
                'description' => 'Sport Category'
            ],
            [
                'category' => 'Health',
                'description' => 'Health Category'
            ],
            [
                'category' => 'Science',
                'description' => 'Science Category'
            ],
            [
                'category' => 'Technology',
                'description' => 'Technology Category'
            ],
            [
                'category' => 'Photo',
                'description' => 'Photo Category'
            ],
            [
                'category' => 'Video',
                'description' => 'Video Category'
            ],
            [
                'category' => 'Others',
                'description' => 'Others Category'
            ],
        ]);
    }
}
