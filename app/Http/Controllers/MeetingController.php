<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Client;
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
        $meetings = Meeting::latest()->paginate(12); 
        return view('meetings.index', ['meetings' => $meetings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $slot_id)
    {
        $slot = Slot::find($slot_id);
        if ($slot->is_occupied == 0) {
            return view('meetings.create', ['slot' => $slot]);
        } else {
            return redirect()->route('meetings.show', ['slot' => $slot_id]);
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
        DB::transaction(function () use ($bookinfo) {

            //client
            $client = Client::where('phone', $bookinfo["phone"])->first();
            if ($client) {
                if ($client->name != $bookinfo["name"]) {
                    $client->update([
                        'name_addition' => $bookinfo["name"],
                    ]);
                }
                if ($client->email != $bookinfo["email"]) {
                    $client->update([
                        'email_addition' => $bookinfo["email"],
                    ]);
                }
            } else {
                $client = Client::create([
                    'name' => $bookinfo['name'],
                    'email' => $bookinfo['email'],
                    'phone' => $bookinfo['phone'],
                ]);
            }

            //meeting
            Meeting::create([
                'unit_id' => $bookinfo['unit_id'],
                'slot_id' => $bookinfo['slot_id'],
                'client_id' => $client->id,
                'booked_datetime' => $bookinfo['booked_datetime'],
                'status' => $bookinfo['status'],
            ]);

            //slot
            $slot = Slot::find($bookinfo['slot_id']);
            $slot->update([
                'is_occupied' => true,
            ]);

        });

        $slot = Slot::find($bookinfo['slot_id']);
        return redirect()->route('slots.index', ['departament' => $slot->unit->departament_id, 'unit' => $slot->unit_id])->with('success', 'Встреча создана!');

    }

    /**
     * Display the specified resource.
     */
    public function show(int $slot_id)
    {
        $meeting = Meeting::where('slot_id', $slot_id)->first();
        // $client = Slot::find($slot_id);
        // dd($meeting->client);
        return view('meetings.show', ['meeting' => $meeting]);
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
