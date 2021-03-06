<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTagTableSeeder extends Seeder
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
            for($l=1; $l<=2; $l++){
                DB::table('user_tags')->insert([
                    'tag_id' => $faker->numberBetween(1, 50),
                    'user_id' => $i,
                ]);
            }
        }
    }
}
