<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DepartamentController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\MeetingController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {



    Route::get('/test-auth', function (Request $request) {
        return response()->json([
            'message' => 'Вы успешно прошли аутентификацию и получили доступ к защищенному маршруту!',
            'user' => $request->user(),
        ]);
    });

    Route::get('/departaments', [DepartamentController::class, 'index']);


    Route::get('/departaments/{departmentId}/units', [UnitController::class, 'unitsByDepartment']);

    Route::post('/meetings/store', [MeetingController::class, 'store']);


});
