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
    public function create(int $departament_id, int $unit_id)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        ;
        $plusDate = Carbon::now()->addWeek()->format('Y-m-d');
        ;
        $unit_name = Unit::find($unit_id)->name;
        return view('slots.create', ['departament_id' => $departament_id, 'unit_id' => $unit_id, 'unit_name' => $unit_name, 'currentDate' => $currentDate, 'plusDate' => $plusDate]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // получим массив дней недели юнита в формате чисел
        $unit = Unit::find($request->unit_id);
        $weekdaysString = json_decode($unit->weekday);
        $unit_weekdays = [];
        foreach ($weekdaysString as $weekday) {
            $timestamp = strtotime($weekday);
            $dayOfWeekInt = date('w', $timestamp);
            $unit_weekdays[] = $dayOfWeekInt;
        }
        // получили



        $duration_minutes = $unit->duration_minutes;
        $unit_start = Carbon::parse($unit->start_time);
        $unit_end = Carbon::parse($unit->end_time);

        $period_start = Carbon::parse($request->start_date);
        $period_end = Carbon::parse($request->end_date);

        $currentDay = $period_start;
        $slots = [];
$i = 0;
        while ($currentDay <= $period_end) {
            $dayOfWeek = $currentDay->dayOfWeek;
            if (in_array($dayOfWeek, $unit_weekdays)) {
                $time_temp = $unit_start;
                
                while ($time_temp <= $unit_end) {
                    $datetime_temp = $currentDay->addHours($time_temp->hour);
                    $datetime_temp = $datetime_temp->addMinutes($time_temp->minute);
                    array_push($slots, $i);
                    $time_temp->addMinutes($duration_minutes);
                    if ($i == 1) {
                        dd($slots);
                    }
                    // $i = $i + 1;
                }
                // dd($slots);
                $currentDay->addDay();
                $i = $i + 1;
            } else {
                // Пропускаем день
                $currentDay->addDay();
            }
        }

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
