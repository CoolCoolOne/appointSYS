<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('content.api_docs');

    }
    public function profile()
    {
        return view('content.profile');
    }
}
