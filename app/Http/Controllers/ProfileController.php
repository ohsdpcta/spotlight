<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Profile;

class ProfileController extends Controller
{
    public function profile(Request $request, $id) {
        $data = Profile::where('user_id', $id)->get();
        return view('profile.profile', ['data' => $data]);
    }
}
