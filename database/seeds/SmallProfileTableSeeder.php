<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Provider\DateTime;

class SmallProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=50; $i++){
            DB::table('smallprofile')->insert([
                'user_id' => $i,
                'scomment' => Str::random(30),
                'created_at' => DateTime::dateTimeThisDecade(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
