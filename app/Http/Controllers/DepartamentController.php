<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartamentController extends Controller
{
    public function index()
    {
        $departaments = Departament::latest()->paginate(10); 
        return view('departaments.index', compact('departaments'));
    }


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
        $departament_id = $departament->id;
        
        return redirect()->route('units.index', ['departament' => $departament_id]);
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
