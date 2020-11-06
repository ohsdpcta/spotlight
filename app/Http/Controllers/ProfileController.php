<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Profile;

class ProfileController extends Controller
{
    public function profile() {
        $data = [
            'content' => '適当',
        ];
        return view('profile.profile', $data);
    }
}
