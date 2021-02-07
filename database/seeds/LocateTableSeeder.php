<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        $gmap_url = [
            '36.643580605012055, 138.19138537568583',
            '43.72301579385695, 10.396608141836984',
            '43.687697486338266, 10.481576799108526',
            '44.44246349721228, 26.100184012563076',
            '35.716465214298985, 139.76193793127192',
            '38.037133423819384, 138.42128048274387',
        ];
        for($i=1; $i<=50; $i++){
            $l = $i % 6;
            DB::table('locates')->insert([
                'user_id' => $i,
                'coordinate' => $gmap_url[$l],
            ]);
        }
    }
}
