<?php

use Illuminate\Database\Seeder;

class AttachmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Infogue\Attachment::class, 50)->create();
    }
}
