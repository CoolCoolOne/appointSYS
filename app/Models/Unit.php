<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'departament_id',
        'weekday',
        'start_time',
        'end_time',
        'duration_minutes'
    ];

    public function user()
    {
        return $this->belongsTo(Departament::class);
    }

    public function convertWeekday(string $weekdays)
    {
        $other = array("[", "]", "\"");
        $weekdays = str_replace($other, "", $weekdays);
        $eng = array("Mon");
        $weekdays = str_replace($eng, "Пн", $weekdays);
        $eng = array("Tue");
        $weekdays = str_replace($eng, "Вт", $weekdays);
        $eng = array("Wed");
        $weekdays = str_replace($eng, "Ср", $weekdays);
        $eng = array("Thu");
        $weekdays = str_replace($eng, "Чт", $weekdays);
        $eng = array("Fri");
        $weekdays = str_replace($eng, "Пт", $weekdays);
        $eng = array("Sat");
        $weekdays = str_replace($eng, "Сб", $weekdays);
        $eng = array("Sun");
        $weekdays = str_replace($eng, "Вс", $weekdays);
        return $weekdays;
    }
}
