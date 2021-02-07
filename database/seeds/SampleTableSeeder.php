<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        $youtube_url = array(
            'https://www.youtube.com/embed/hT_nvWreIhg',
            'https://www.youtube.com/embed/XogSflwXgpw',
            'https://www.youtube.com/embed/zPMWAj54Seg',
            'Counting Stars',
            'アスノヨゾラ哨戒班',
            'Virtual to Live',
        );
        $youtube_list_url = array(
            'PLQQRlrmo51ig5gN8FZskF2paM1AnAUSfo',
            'PLQQRlrmo51igpX7Ag1ZHGFUcvtXHADQEl',
            'PLQQRlrmo51ihbHS8nCwjbfWn9_UCMFaFw',
            'ポケモン',
            '名曲',
            'インド',
        );
        $soundcloud_url = array(
            'a:5:{i:0;a:5:{i:0;s:225:"src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/1194385924&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"";i:1;s:46:"href="https://soundcloud.com/s-taji-939453225"";i:2;s:8:"title="s";i:3;s:63:"href="https://soundcloud.com/s-taji-939453225/sets/top-50-rock"";i:4;s:10:"title="Top";}i:1;a:5:{i:0;s:219:"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/1194385924&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";}i:2;a:5:{i:0;s:0:"";i:1;s:39:"https://soundcloud.com/s-taji-939453225";i:2;s:0:"";i:3;s:56:"https://soundcloud.com/s-taji-939453225/sets/top-50-rock";i:4;s:0:"";}i:3;a:5:{i:0;s:0:"";i:1;s:0:"";i:2;s:1:"s";i:3;s:0:"";i:4;s:3:"Top";}i:4;a:5:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";}}',
            'a:5:{i:0;a:5:{i:0;s:225:"src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/1194385840&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"";i:1;s:46:"href="https://soundcloud.com/s-taji-939453225"";i:2;s:8:"title="s";i:3;s:68:"href="https://soundcloud.com/s-taji-939453225/sets/top-50-drum-bass"";i:4;s:10:"title="Top";}i:1;a:5:{i:0;s:219:"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/1194385840&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";}i:2;a:5:{i:0;s:0:"";i:1;s:39:"https://soundcloud.com/s-taji-939453225";i:2;s:0:"";i:3;s:61:"https://soundcloud.com/s-taji-939453225/sets/top-50-drum-bass";i:4;s:0:"";}i:3;a:5:{i:0;s:0:"";i:1;s:0:"";i:2;s:1:"s";i:3;s:0:"";i:4;s:3:"Top";}i:4;a:5:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";}}',
            'a:5:{i:0;a:5:{i:0;s:225:"src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/1193931922&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"";i:1;s:46:"href="https://soundcloud.com/s-taji-939453225"";i:2;s:8:"title="s";i:3;s:75:"href="https://soundcloud.com/s-taji-939453225/sets/top-50-alternative-rock"";i:4;s:10:"title="Top";}i:1;a:5:{i:0;s:219:"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/1193931922&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";}i:2;a:5:{i:0;s:0:"";i:1;s:39:"https://soundcloud.com/s-taji-939453225";i:2;s:0:"";i:3;s:68:"https://soundcloud.com/s-taji-939453225/sets/top-50-alternative-rock";i:4;s:0:"";}i:3;a:5:{i:0;s:0:"";i:1;s:0:"";i:2;s:1:"s";i:3;s:0:"";i:4;s:3:"Top";}i:4;a:5:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";}}',
            'Top 50: Rock',
            'Top 50: Drum &amp',
            'Top 50: Alternative Rock',
        );
        for($i=1; $i<=50; $i++){
            for($l=1; $l<=3; $l++){
                if($l == 1){
                    $s = rand(0, 2);
                    DB::table('sample')->insert([
                        'user_id' => $i,
                        'name' => $youtube_url[$s + 3],
                        'url' => $youtube_url[$s],
                        'embed_site' => "youtube",
                    ]);
                }elseif($l == 2){
                    $s = rand(0, 2);
                    DB::table('sample')->insert([
                        'user_id' => $i,
                        'name' => $youtube_list_url[$s + 3],
                        'url' => $youtube_list_url[$s],
                        'embed_site' => "youtube_list",
                    ]);
                }elseif($l == 3){
                    $s = rand(0, 2);
                    DB::table('sample')->insert([
                        'user_id' => $i,
                        'name' => $soundcloud_url[$s + 3],
                        'url' => $soundcloud_url[$s],
                        'embed_site' => "soundcloud",
                    ]);
                }
            }
        }
    }
}
