<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
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
    public function create(int $slot_id)
    {
        $slot = Slot::find($slot_id);
        if ($slot->status == 0) {
            return view('meetings.create', ['slot' => $slot]);
        } else {
            dd('stub. На редактирование, тк слот уже занят');
            // return redirect()->route('meetings.edit', ['' => ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $phone = str_replace(['(', ')', ' ', '-'], '', $request->phone);
        Validator::make(['phone' => $phone], ['phone' => 'required|regex:/[0-9]{9}$/',])->validate();
        if ($phone[0] == 8) {
            $phone = substr_replace($phone, "+7", 0, 1);
        }


        $bookinfo = $request->validate([
            'status' => 'required',
            'unit_id' => 'required',
            'slot_id' => 'required',
            'booked_datetime' => 'required',
            'name' => 'required|max:100',
            'email' => 'email',
        ]);
        $bookinfo["phone"] = $phone;

        dd($bookinfo);

        DB::transaction(function () {


        });

    }

    /**
     * Display the specified resource.
     */
    public function show(meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(meeting $meeting)
    {
        //
    }
}
