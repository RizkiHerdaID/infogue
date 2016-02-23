<?php

use Illuminate\Database\Seeder;

class ConversationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Infogue\Conversation::class, 300)->create();
    }
}
