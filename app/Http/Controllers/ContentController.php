<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    //

    public function userlist()
    {
        $users = User::paginate(10,["id", "name", "email_verified_at", "email"]);
        return view('content.userlist', compact('users'));

    }
    public function api_docs()
    {
        $user = Auth::user();
        $api_key = $user->api_key;
        return view('content.api_docs', [
            'api_key_raw' => $api_key
        ]);
    }

    public function profile()
    {
        return view('content.profile');
    }
}
