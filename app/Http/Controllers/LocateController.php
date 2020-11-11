<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Profile;
use App\Follower;

class LocateController extends Controller
{
    public function map(Request $request, $id) {

        $data = tekitou::find($id);
        $locate = tekitou::where('taeget_id' $id);

        return view('locate.map', compact('data', 'follow_flg', 'follower'));
    }
}
