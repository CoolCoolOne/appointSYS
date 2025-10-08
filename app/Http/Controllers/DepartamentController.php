<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $departaments = Departament::latest()->where('user_id', $user_id)->paginate(10); 
        return view('departaments.index', compact('departaments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departaments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        $user_id = Auth::id();
        Departament::create([
            'name' => $request['name'],
            'user_id' => $user_id,
        ]);
        return redirect()->route('departaments.index')->with('success', 'Отдел создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departament $departament)
    {
        return view('departaments.show', compact('departament'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(resourse $resourse)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, resourse $resourse)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departament $departament)
    {
        $departament->delete();

        return redirect()->route('departaments.index')->with('success', 'Отдел удален!');
    }
}
