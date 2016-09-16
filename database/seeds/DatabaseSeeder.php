<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(FeedbackTableSeeder::class);
        $this->call(VisitorsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(ContributorsTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
        $this->call(FollowersTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ConversationTableSeeder::class);
        $this->call(AttachmentsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ArticleTagsTableSeeder::class);
        $this->call(SubscribersTableSeeder::class);
        $this->call(ImagesTableSeeder::class);

        Model::reguard();
    }
}
