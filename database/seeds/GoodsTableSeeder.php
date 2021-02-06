<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsTableSeeder extends Seeder
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
            for($l=1; $l<=7; $l++){
                DB::table('goods')->insert([
                    'user_id' => $i,
                    'name' => $faker->colorName,
                    'url' => $faker->url,
                ]);
            }
        }
    }
}
