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
        $latestToken = $user->tokens()->latest()->first();
        return view('content.api_docs', [
            'latestToken' => $latestToken,
            'newTokenRaw' => session('api_token')
        ]);
    }

    public function profile()
    {
        return view('content.profile');
    }
}
