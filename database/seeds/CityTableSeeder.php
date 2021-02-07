<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Provider\DateTime;

class CityTableSeeder extends Seeder
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
            DB::table('cities')->insert([
                'name' => $faker->unique()->city,
                'created_at' => DateTime::dateTimeThisDecade(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
