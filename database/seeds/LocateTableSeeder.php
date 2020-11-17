<?php

use Illuminate\Database\Seeder;

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
            'https://www.google.co.jp/maps/place/%E3%80%92380-0921+%E9%95%B7%E9%87%8E%E7%9C%8C%E9%95%B7%E9%87%8E%E5%B8%82%E6%A0%97%E7%94%B0+%E5%A4%A7%E5%8E%9F%E5%AD%A6%E5%9C%92/@36.6436158,138.1891744,17z/data=!3m1!4b1!4m5!3m4!1s0x601d868da5158897:0xfb55279be630ebd3!8m2!3d36.6436158!4d138.1913631',
            'https://www.google.com/maps/place/%E6%9D%B1%E4%BA%AC%E3%83%93%E3%83%83%E3%82%B0%E3%82%B5%E3%82%A4%E3%83%88/@35.6298179,139.7920981,17z/data=!3m1!4b1!4m5!3m4!1s0x601889dc629d1e7b:0xa4d1509a76045a01!8m2!3d35.6298179!4d139.7942868?hl=ja',
            'https://www.google.com/maps/place/%E3%82%BF%E3%83%BC%E3%82%B8%E3%83%BB%E3%83%9E%E3%83%8F%E3%83%AB/@27.1751448,78.0399535,17z/data=!3m1!4b1!4m5!3m4!1s0x39747121d702ff6d:0xdd2ae4803f767dde!8m2!3d27.1751448!4d78.0421422?hl=ja',
            'https://www.google.com/maps/place/%E3%83%93%E3%83%83%E3%82%B0%E3%83%BB%E3%83%99%E3%83%B3/@51.5007292,-0.1268141,17z/data=!3m1!4b1!4m5!3m4!1s0x487604c38c8cd1d9:0xb78f2474b9a45aa9!8m2!3d51.5007292!4d-0.1246254?hl=ja',
        ];
        for($i=1; $i<=50; $i++){
            $l = $i % 4;
            DB::table('locates')->insert([
                'user_id' => $i,
                'coordinate' => $gmap_url[$l],
            ]);
        }
    }
}
