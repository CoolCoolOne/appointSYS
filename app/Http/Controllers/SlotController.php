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

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

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



        $unit->duration_minutes;
        $unit->start_time;
        $unit->end_time;

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $slots = [];

        while ($start <= $end) {
            $dayOfWeek = $start->dayOfWeek;
            if (in_array($dayOfWeek, $activeDays)) {
                // Добавляем интервал, если он находится в пределах общего диапазона
                $currentSlotStart = $start->format('Y-m-d H:i:s');
                $start->add($interval);
                if ($start <= $end) {
                    $slots[] = [
                        'start' => $currentSlotStart,
                        'end' => $start->format('Y-m-d H:i:s'),
                    ];
                } else {
                    // Если последний интервал выходит за пределы конечной даты
                    $slots[] = [
                        'start' => $currentSlotStart,
                        'end' => $end->format('Y-m-d H:i:s'),
                    ];
                }
            } else {
                // Пропускаем день, если он неактивный
                $start->modify('next midnight');
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
