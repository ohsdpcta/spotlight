<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Provider\DateTime;


class MapTableSeeder extends Seeder
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
            DB::table('map')->insert([
                'user_id' => $i,
                'street_address' => 'https://www.google.co.jp/maps/place/%E3%80%92380-0921+%E9%95%B7%E9%87%8E%E7%9C%8C%E9%95%B7%E9%87%8E%E5%B8%82%E6%A0%97%E7%94%B0+%E5%A4%A7%E5%8E%9F%E5%AD%A6%E5%9C%92/@36.6436158,138.1891744,17z/data=!3m1!4b1!4m5!3m4!1s0x601d868da5158897:0xfb55279be630ebd3!8m2!3d36.6436158!4d138.1913631',

            ]);
        }
    }
}
