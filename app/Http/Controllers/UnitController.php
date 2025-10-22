<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Unit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


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
        $departament_name = Departament::find($departament_id)->name;
        return view('units.create',['departament_name'=>$departament_name,'departament_id' => $departament_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $departament_id, Request $request)
    {
        // dd($request->all());
        $start_time = Carbon::parse($request->start_time);
        $end_time = Carbon::parse($request->end_time);
        $validator_dif = $start_time->diffInMinutes($end_time);
        Validator::make(['time_diffenrence' => $validator_dif], ['time_diffenrence' => 'gt:10',])->validate();

        $start_time = $start_time->format('H:i');
        $end_time = $end_time->format('H:i');
        
         $request->validate([
            'name' => 'required|max:100',
            'days' => 'required',
            "start_time" => "required",
            "end_time" => "required",
            "duration_minutes" => "required",
        ]);
        $days = json_encode($request->days);
        // dd($departament_id);
        Unit::create([
            'name' => $request['name'],
            'departament_id' => $departament_id,
            'weekday' => $days,
            "start_time" => $start_time,
            'end_time' => $end_time,
            'duration_minutes' => $request['duration_minutes'],
        ]);
        return redirect()->route('units.index', ['departament' => $departament_id])->with('success', 'Юнит создан!');
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
        $departament=$unit->departament_id;
        dd($departament);
        $unit->delete();

        return redirect()->route('units.index', ['departament' => 1])->with('success', 'Юнит удален!');
    }
}
