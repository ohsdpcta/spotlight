<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sample;

class SampleController extends Controller
{
    public function sample(Request $request, $id) {
        $data = Sample::where('user_id', $id)->get();
        return view('sample.sample', compact('data'));
    }

    public function add(Request $request) {
        return view('sample.add');
    }

    public function create(Request $request, $id) {
        // レコードを追加する。
        $addsample = new Sample;
        $addsample->user_id = $id;
        $addsample->name = $request->name;
        $addsample->url = $request->url;
        $addsample->save();
        return redirect("user/{$id}/sample");
    }

    public function del(Request $request, $id) {
        $data = Sample::where('id', $id)->get();
        return view('sample.del', compact('data'));
    }

    public function remove(Request $request, $id) {
        // レコードを削除する。
        $return = Sample::find($id);
        Sample::where('id', $id)->delete();
        return redirect("/user/{$return->user_id}/sample");
    }
}
