<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Unit;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $departament_id, int $unit_id)
    {
        $unit = Unit::find($unit_id);
        $slots = Slot::all()->where('unit_id', $unit_id);
        if ($slots->count() === 0) {
            return redirect()->route('slots.create', [$departament_id, $unit_id])->with('success', 'У юнита нет слотов, создайте их!');
        } else {
            return view('slots.index', ['slots' => $slots, 'unit' => $unit]);
        }
        ;

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

        $period_start_clone = clone $period_start;

        $datetime_oneday_start = $period_start_clone->addHours($unit_start->hour);
        $datetime_oneday_start = $datetime_oneday_start->addMinutes($unit_start->minute);

        $period_start_clone = clone $period_start;

        $datetime_oneday_end = $period_start_clone->addHours($unit_end->hour);
        $datetime_oneday_end = $datetime_oneday_end->addMinutes($unit_end->minute);

        $datetime_oneday_start_swapday = clone $datetime_oneday_start;
        $datetime_oneday_end_swapday = clone $datetime_oneday_end;

        $slots = [];

        while ($period_start_clone <= $period_end) {
            $dayOfWeek = $period_start_clone->dayOfWeek;
            if (in_array($dayOfWeek, $unit_weekdays)) {


                while ($datetime_oneday_start < $datetime_oneday_end) {
                    $datetime_oneday_store = clone $datetime_oneday_start;
                    // array_push($slots, $datetime_oneday_store->format('Y-m-d H:i:s'));
                    $slots[] = ['slot_datetime' => $datetime_oneday_store->format('Y-m-d H:i:s'), 'unit_id' => $request->unit_id];
                    $datetime_oneday_start->addMinutes($duration_minutes);
                }

                $datetime_oneday_start_swapday->addDay();
                $datetime_oneday_end_swapday->addDay();
                $datetime_oneday_start = clone $datetime_oneday_start_swapday;
                $datetime_oneday_end = clone $datetime_oneday_end_swapday;

                $period_start_clone->addDay();
            } else {
                // Пропускаем день
                $datetime_oneday_start_swapday->addDay();
                $datetime_oneday_end_swapday->addDay();
                $datetime_oneday_start = clone $datetime_oneday_start_swapday;
                $datetime_oneday_end = clone $datetime_oneday_end_swapday;
                $period_start_clone->addDay();

            }
        }

        DB::transaction(function () use ($slots) {
            foreach ($slots as $slot) {
                Slot::create($slot);
            }
        });

        return redirect()->route('units.index', ['departament' => $unit->departament_id])->with('success', 'Слоты созданы!');
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
