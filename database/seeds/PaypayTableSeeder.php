<?php

use Illuminate\Database\Seeder;

class PaypayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = [
            'https://qr.paypay.ne.jp/pGeIFm5q92vTxvIX',
            'https://qr.paypay.ne.jp/ytjB71ur2WHRoI82',
        ];
        for($i=1; $i<=50; $i++){
            $l = $i % 2;
            DB::table('paypays')->insert([
                'user_id' => $i,
                'url' => $url[$l],
            ]);
        }
    }
}
