<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function search(Request $request)
    {   
        $input = $request->input;
        if ($input == '') {
            $result = User::all();
        }else{
            $result = User::where('name', 'like', '%'.$input.'%')->get();
        }
        return view('search.search', ['result' => $result]);
    }
}