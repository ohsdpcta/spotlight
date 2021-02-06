<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        for($i=1; $i<=50; $i++){
            DB::table('tags')->insert([
                'tag_name' => $faker->colorName,
            ]);
        }
    }
}
