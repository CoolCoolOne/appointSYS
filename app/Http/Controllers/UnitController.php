<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Unit;
use Illuminate\Http\Request;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $departament_id)
    {
        $departament_name = Departament::find($departament_id)->name;
        $units = Unit::latest()->where('departament_id', $departament_id)->paginate(10); 
        return view('units.index', ['units' => $units,'departament_name'=>$departament_name, 'departament_id'=>$departament_id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $departament_id)
    {
        return view('units.create',['departament_id' => $departament_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $departament_id, Request $request)
    {
         $request->validate([
            'name' => 'required|max:100',
        ]);
        Unit::create([
            'name' => $request['name'],
            'user_id' => $departament_id,
        ]);
        return redirect()->route('units.index', ['departament_id' => $departament_id])->with('success', 'Юнит создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $departament_id=$unit->departament_id;
        $unit->delete();

        return redirect()->route('units.index', ['departament_id' => $departament_id])->with('success', 'Юнит удален!');
    }
}
