<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Provider\DateTime;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=50; $i++){
            while(1){
                $follower_id = mt_rand(1, 50);
                if($i != $follower_id){
                    break;
                }
            }
            DB::table('followers')->insert([
                'target_id' => $i,
                'follower_id' => $follower_id,
                'created_at' => DateTime::dateTimeThisDecade(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
