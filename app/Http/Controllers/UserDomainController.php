<?php

namespace App\Http\Controllers;

use App\Models\UserDomain;
use Illuminate\Http\Request;


class UserDomainController extends Controller
{
    public function index()
    {
        $domains = UserDomain::latest()->paginate(10); 
        return view('domains.index', compact('domains'));
    }


    public function create()
    {
        return view('domains.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'domain_url' => 'required|max:100|url',
            'note' => 'max:200',
        ]);
        UserDomain::create($validated);
        return redirect()->route('domains.index')->with('success', 'Домен добавлен в список разрешённых!');
    }
    public function destroy(UserDomain $domain)
    {
        $domain->delete();

        return redirect()->route('domains.index')->with('success', 'Домен удалён из списка разрешённых!');
    }
}
