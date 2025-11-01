<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Unit;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $departament_id,int $unit_id)
    {
        $currentDate = Carbon::now()->format('Y-m-d');;
        $plusDate = Carbon::now()->addMonth()->format('Y-m-d');;
        $unit_name = Unit::find($unit_id)->name;
        return view('slots.create', ['departament_id'=>$departament_id,'unit_id' => $unit_id, 'unit_name'=>$unit_name,'currentDate'=>$currentDate,'plusDate'=>$plusDate]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $unit_id, Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(slot $slot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(slot $slot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, slot $slot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(slot $slot)
    {
        //
    }
}
