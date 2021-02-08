<?php

namespace App\Library;

use App\Tag;
use App\Prefecture;
use Illuminate\Support\Facades\DB;

class TagClass{
    static function getTop($data, $amount){
        foreach($data as $item){
            $item_user_amount[$item->id] = $item->user->where('role', 'Performer')->count();
        }
        // 登録件数を降順でソート
        arsort($item_user_amount);
        // 登録件数上位5件を抽出
        $top_item_user_amount = array_slice($item_user_amount, 0, $amount, true);
        // キー(Prefectureのid)のみを配列で抽出
        $top_item_ids = array_keys($top_item_user_amount);
        $ids_order = implode(',', $top_item_ids);
        $get_top_params = array(
            'top_item_ids' => $top_item_ids,
            'ids_order' => $ids_order,
            'top_item_user_amount' => $top_item_user_amount
        );
        return $get_top_params;
    }

    public static function getTopTag(){
        $tags = Tag::select('*')->get();
        if(count($tags)){
            $get_top_params = self::getTop($tags, 10);
            $ids_order = $get_top_params['ids_order'];
            $popular_item = Tag::whereIn('id', $get_top_params['top_item_ids'])
                ->orderByRaw(DB::raw("FIELD(id, $ids_order)"))
                ->get();
            $top_tag = array(
                'tags' => $popular_item,
                'tag_amount' => $get_top_params['top_item_user_amount']
            );
        }else{
            $top_tag = false;
        }
        return $top_tag;
    }

    public static function getTopPrefecture(){
        $prefectures = Prefecture::select('*')->get();
        if(count($prefectures)){
            $get_top_params = self::getTop($prefectures, 5);
            $ids_order = $get_top_params['ids_order'];
            $popular_item = Prefecture::whereIn('id', $get_top_params['top_item_ids'])
                ->orderByRaw(DB::raw("FIELD(id, $ids_order)"))
                ->get();
            $top_pref = array(
                'prefs' => $popular_item,
                'pref_amount' => $get_top_params['top_item_user_amount']
            );
        }else{
            $top_pref = false;
        }
        return $top_pref;
    }
}