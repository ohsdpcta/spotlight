<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ProfileTableSeeder::class,
            FollowersTableSeeder::class,
            LocateTableSeeder::class,
            GoodsTableSeeder::class,
            SampleTableSeeder::class,
            TagsTableSeeder::class,
            UserTagTableSeeder::class,
            SmallProfileTableSeeder::class,
            PrefectureTableSeeder::class,
            UserPrefectureTableSeeder::class,
        ]);
    }
}
