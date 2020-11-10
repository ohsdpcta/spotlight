<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $items = DB::select('select * from goods');
        return view('goods.index', ['items' => $items]);
    }
    
    public function post(Request $request)
    {
        $items = DB::select('select * from goods');
        return view('goods.index', ['items' => $items]);
    }

    public function add(Request $request)
    {
        return view('goods.add');
    }

    public function create(Request $request)
    {
        $param = [
            'name' => $request->name,
            'url' => $request->url,
        ];
        DB::insert('insert into goods (name, url) values
            (:name, :url)', $param);
    }
}

