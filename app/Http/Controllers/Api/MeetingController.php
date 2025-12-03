<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Meeting;
use App\Models\Slot;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class MeetingController extends Controller
{
    /**
     * Store a newly created meeting/booking via API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

        $phone = str_replace(['(', ')', ' ', '-'], '', $request->phone);
        
        $phoneValidator = Validator::make(['phone' => $phone], [
            'phone' => 'required|regex:/^[0-9]{9,15}$/',
        ]);

        if ($phoneValidator->fails()) {
            return response()->json(['message' => 'Ошибка валидации номера телефона.', 'errors' => $phoneValidator->errors()], 422);
        }
        

        if (str_starts_with($phone, '8')) {
            $phone = substr_replace($phone, "+7", 0, 1);
        } elseif (!str_starts_with($phone, '+')) {
             $phone = "+" . $phone;
        }


        $validator = Validator::make($request->all(), [
            'unit_id' => 'required|exists:units,id',
            'slot_id' => 'required|exists:slots,id',
            'name' => 'required|max:100',
            'email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Ошибка валидации входных данных.', 'errors' => $validator->errors()], 422);
        }

        $bookinfo = $validator->validated();
        $bookinfo["phone"] = $phone;
        

        $bookinfo['status'] = 'pending'; 

        $slotDateTime = null;


        try {
            DB::transaction(function () use ($bookinfo, &$slotDateTime) {
                
                $slot = Slot::findOrFail($bookinfo['slot_id']);
                
                if ($slot->is_occupied) {
                     throw new \Exception('Этот слот уже занят.');
                }

                $slotDateTime = $slot->slot_datetime; 

                $client = Client::firstOrCreate(
                    ['phone' => $bookinfo['phone']],
                    [   
                        'name' => $bookinfo['name'], 
                        'email' => $bookinfo['email'] ?? null
                    ]
                );

                
                if ($client->wasRecentlyCreated === false) {
                    if ($client->name != $bookinfo["name"]) {
                        $client->name_addition = $bookinfo["name"];
                    }
                    if ($client->email != ($bookinfo["email"] ?? null)) {
                        $client->email_addition = $bookinfo["email"];
                    }
                    if ($client->isDirty()) {
                        $client->save();
                    }
                }

                // Создание встречи
                Meeting::create([
                    'unit_id' => $bookinfo['unit_id'],
                    'slot_id' => $bookinfo['slot_id'],
                    'client_id' => $client->id,
                    'booked_datetime' => $slotDateTime,
                    'status' => $bookinfo['status'], 
                ]);


                $slot->update(['is_occupied' => true]);

            });
            
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Выбранный слот или объект не найден.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Не удалось забронировать слот.', 'error' => $e->getMessage()], 409);
        }

        return response()->json([
            'message' => 'Встреча успешно создана со статусом "pending"!',
            'slot_id' => $bookinfo['slot_id'],
            'booked_datetime' => $slotDateTime,
            'status' => $bookinfo['status']
        ], 201); // 201 Created
    }
}