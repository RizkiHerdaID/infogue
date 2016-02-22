<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            [
                'category_id' => '1',
                'subcategory' => 'Politic',
                'label' => 'Featured',
                'description' => 'Politic Sub Category'
            ],
            [
                'category_id' => '1',
                'subcategory' => 'World',
                'label' => 'Featured',
                'description' => 'World Sub Category'
            ],
            [
                'category_id' => '1',
                'subcategory' => 'Issues',
                'label' => 'Featured',
                'description' => 'Issues Sub Category'
            ],
            [
                'category_id' => '1',
                'subcategory' => 'Opinion',
                'label' => 'Featured',
                'description' => 'Opinion Sub Category'
            ],
            [
                'category_id' => '1',
                'subcategory' => 'Hot',
                'label' => 'Featured',
                'description' => 'Hot Sub Category'
            ],

            [
                'category_id' => '1',
                'subcategory' => 'Regional',
                'label' => 'Light News',
                'description' => 'Regional Sub Category'
            ],
            [
                'category_id' => '1',
                'subcategory' => 'Profile',
                'label' => 'Light News',
                'description' => 'Profile Sub Category'
            ],
            [
                'category_id' => '1',
                'subcategory' => 'Debate',
                'label' => 'Light News',
                'description' => 'Debate Sub Category'
            ],
            [
                'category_id' => '1',
                'subcategory' => 'Interview',
                'label' => 'Light News',
                'description' => 'Interview Sub Category'
            ],

            [
                'category_id' => '1',
                'subcategory' => 'Latest',
                'label' => 'Headline',
                'description' => 'Latest Sub Category'
            ],
            [
                'category_id' => '1',
                'subcategory' => 'Trending',
                'label' => 'Headline',
                'description' => 'Trending Sub Category'
            ],

            [
                'category_id' => '2',
                'subcategory' => 'Finance',
                'label' => 'Business',
                'description' => 'Finance Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Stock',
                'label' => 'Business',
                'description' => 'Stock Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Micro Business',
                'label' => 'Business',
                'description' => 'Micro Business Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Management',
                'label' => 'Business',
                'description' => 'Management Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Strategy',
                'label' => 'Business',
                'description' => 'Strategy Sub Category'
            ],

            [
                'category_id' => '2',
                'subcategory' => 'Government',
                'label' => 'National',
                'description' => 'Government Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Market',
                'label' => 'National',
                'description' => 'Market Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Exchange',
                'label' => 'National',
                'description' => 'Exchange Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Export',
                'label' => 'National',
                'description' => 'Export Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Import',
                'label' => 'National',
                'description' => 'Import Sub Category'
            ],

            [
                'category_id' => '2',
                'subcategory' => 'Accounting',
                'label' => 'Academic',
                'description' => 'Accounting Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Book',
                'label' => 'Academic',
                'description' => 'Book Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Startup',
                'label' => 'Academic',
                'description' => 'Startup Sub Category'
            ],
            [
                'category_id' => '2',
                'subcategory' => 'Policy',
                'label' => 'Academic',
                'description' => 'Policy Sub Category'
            ],

            [
                'category_id' => '3',
                'subcategory' => 'International',
                'label' => 'Extravaganza',
                'description' => 'International Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Celebrities',
                'label' => 'Extravaganza',
                'description' => 'Celebrities Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Film',
                'label' => 'Extravaganza',
                'description' => 'Film Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Music',
                'label' => 'Extravaganza',
                'description' => 'Music Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Game',
                'label' => 'Extravaganza',
                'description' => 'Game Sub Category'
            ],

            [
                'category_id' => '3',
                'subcategory' => 'Jokes',
                'label' => 'Daily',
                'description' => 'Jokes Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Lifestyle',
                'label' => 'Daily',
                'description' => 'Lifestyle Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Vacation',
                'label' => 'Daily',
                'description' => 'Vacation Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Festival',
                'label' => 'Daily',
                'description' => 'Festival Sub Category'
            ],

            [
                'category_id' => '3',
                'subcategory' => 'Anime',
                'label' => 'Hobby',
                'description' => 'Anime Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Handcraft',
                'label' => 'Hobby',
                'description' => 'Handcraft Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Outdoor',
                'label' => 'Hobby',
                'description' => 'Outdoor Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Collector',
                'label' => 'Hobby',
                'description' => 'Collector Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Art',
                'label' => 'Hobby',
                'description' => 'Art Sub Category'
            ],

            [
                'category_id' => '3',
                'subcategory' => 'K-Pop',
                'label' => 'Other',
                'description' => 'K-Pop Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'J-Pop',
                'label' => 'Other',
                'description' => 'J-Pop Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Trend',
                'label' => 'Other',
                'description' => 'Trend Sub Category'
            ],
            [
                'category_id' => '3',
                'subcategory' => 'Party',
                'label' => 'Other',
                'description' => 'Party Sub Category'
            ],

            [
                'category_id' => '4',
                'subcategory' => 'Soccer',
                'label' => 'Popular',
                'description' => 'Soccer Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Tennis',
                'label' => 'Popular',
                'description' => 'Tennis Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Moto GP',
                'label' => 'Popular',
                'description' => 'Moto GP Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Formula 1',
                'label' => 'Popular',
                'description' => 'Formula 1 Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Basket',
                'label' => 'Popular',
                'description' => 'Basket Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Badminton',
                'label' => 'Popular',
                'description' => 'Badminton Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Volley',
                'label' => 'Popular',
                'description' => 'Volley Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Athletic',
                'label' => 'Popular',
                'description' => 'Athletic Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Rally',
                'label' => 'Popular',
                'description' => 'Rally Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Bicycle',
                'label' => 'Popular',
                'description' => 'Bicycle Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Extreme Sport',
                'label' => 'Popular',
                'description' => 'Extreme Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Freestyle',
                'label' => 'Popular',
                'description' => 'Freestyle Sub Category'
            ],

            [
                'category_id' => '4',
                'subcategory' => 'World Cup',
                'label' => 'Event',
                'description' => 'World Cup Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Olympic',
                'label' => 'Event',
                'description' => 'Olympic Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Champion',
                'label' => 'Event',
                'description' => 'Champion Sub Category'
            ],
            [
                'category_id' => '4',
                'subcategory' => 'Schedule',
                'label' => 'Event',
                'description' => 'Schedule Sub Category'
            ],

            [
                'category_id' => '5',
                'subcategory' => 'Medication',
                'label' => 'Medic',
                'description' => 'Medication Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Disease',
                'label' => 'Medic',
                'description' => 'Disease Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Symptom',
                'label' => 'Medic',
                'description' => 'Symptom Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Knowledge',
                'label' => 'Medic',
                'description' => 'Knowledge Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Drug',
                'label' => 'Medic',
                'description' => 'Drug Sub Category'
            ],

            [
                'category_id' => '5',
                'subcategory' => 'Lifestyle',
                'label' => 'Life',
                'description' => 'Lifestyle Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Exercise',
                'label' => 'Life',
                'description' => 'Exercise Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Food',
                'label' => 'Life',
                'description' => 'Food Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Diet',
                'label' => 'Life',
                'description' => 'Diet Sub Category'
            ],

            [
                'category_id' => '5',
                'subcategory' => 'Ask Doctor',
                'label' => 'Doctor',
                'description' => 'Ask Doctor Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Medical Journal',
                'label' => 'Doctor',
                'description' => 'Medical Journal Sub Category'
            ],
            [
                'category_id' => '5',
                'subcategory' => 'Hospital',
                'label' => 'Doctor',
                'description' => 'Hospital Sub Category'
            ],

            [
                'category_id' => '6',
                'subcategory' => 'Discovery',
                'label' => 'Knowledge',
                'description' => 'Discovery Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Research',
                'label' => 'Knowledge',
                'description' => 'Research Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Astronomy',
                'label' => 'Knowledge',
                'description' => 'Astronomy Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Human',
                'label' => 'Knowledge',
                'description' => 'Human Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Earth',
                'label' => 'Knowledge',
                'description' => 'Earth Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Language',
                'label' => 'Knowledge',
                'description' => 'Language Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Chemistry',
                'label' => 'Knowledge',
                'description' => 'Chemistry Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Biology',
                'label' => 'Knowledge',
                'description' => 'Biology Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Physics',
                'label' => 'Knowledge',
                'description' => 'Physics Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'History',
                'label' => 'Knowledge',
                'description' => 'History Sub Category'
            ],

            [
                'category_id' => '6',
                'subcategory' => 'Communication',
                'label' => 'Engineering',
                'description' => 'Communication Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Construction',
                'label' => 'Engineering',
                'description' => 'Construction Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Electrical',
                'label' => 'Engineering',
                'description' => 'Electrical Sub Category'
            ],
            [
                'category_id' => '6',
                'subcategory' => 'Otomotive',
                'label' => 'Engineering',
                'description' => 'Otomotive Sub Category'
            ],

            [
                'category_id' => '7',
                'subcategory' => 'IT',
                'label' => 'Computer',
                'description' => 'IT Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Gadget',
                'label' => 'Computer',
                'description' => 'Gadget Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Software',
                'label' => 'Computer',
                'description' => 'Software Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Hardware',
                'label' => 'Computer',
                'description' => 'Hardware Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Internet',
                'label' => 'Computer',
                'description' => 'Internet Sub Category'
            ],

            [
                'category_id' => '7',
                'subcategory' => 'Future',
                'label' => 'Concept',
                'description' => 'Future Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Programming',
                'label' => 'Concept',
                'description' => 'Programming Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Cyber Security',
                'label' => 'Concept',
                'description' => 'Cyber Security Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'UI Interaction',
                'label' => 'Concept',
                'description' => 'UI Interaction Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Social Network',
                'label' => 'Concept',
                'description' => 'Social Network Sub Category'
            ],

            [
                'category_id' => '7',
                'subcategory' => 'Blackberry',
                'label' => 'Handheld',
                'description' => 'Blackberry Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Android',
                'label' => 'Handheld',
                'description' => 'Android Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'iOS',
                'label' => 'Handheld',
                'description' => 'iOS Sub Category'
            ],
            [
                'category_id' => '7',
                'subcategory' => 'Windows Phone',
                'label' => 'Handheld',
                'description' => 'Windows Phone Sub Category'
            ],

            [
                'category_id' => '10',
                'subcategory' => 'Motivation',
                'label' => 'Life',
                'description' => 'Motivation Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Family',
                'label' => 'Life',
                'description' => 'Family Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Career',
                'label' => 'Life',
                'description' => 'Career Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Friendship',
                'label' => 'Life',
                'description' => 'Friendship Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Relationship',
                'label' => 'Life',
                'description' => 'Relationship Sub Category'
            ],

            [
                'category_id' => '10',
                'subcategory' => 'Life Hack',
                'label' => 'Miscellaneous',
                'description' => 'Life Hack Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'The Lounge',
                'label' => 'Miscellaneous',
                'description' => 'The Lounge Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Opinion',
                'label' => 'Miscellaneous',
                'description' => 'Opinion Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Society',
                'label' => 'Miscellaneous',
                'description' => 'Society Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Education',
                'label' => 'Miscellaneous',
                'description' => 'Education Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Idea',
                'label' => 'Miscellaneous',
                'description' => 'Idea Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Sharing',
                'label' => 'Miscellaneous',
                'description' => 'Sharing Sub Category'
            ],
            [
                'category_id' => '10',
                'subcategory' => 'Others',
                'label' => 'Miscellaneous',
                'description' => 'Others Sub Category'
            ],
        ]);

    }
}
