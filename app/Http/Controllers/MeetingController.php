<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Slot;
use Illuminate\Http\Request;

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
        dd($request->all());
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
