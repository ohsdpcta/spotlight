<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Provider\DateTime;

class UserPrefectureTableSeeder extends Seeder
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
            DB::table('user_prefectures')->insert([
                'user_id' => $i,
                'prefecture_id' => $faker->numberBetween(1, 47),
                'created_at' => DateTime::dateTimeThisDecade(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
