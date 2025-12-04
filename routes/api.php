<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DepartamentController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\MeetingController;
use App\Http\Middleware\CustomCorsMiddleware;

Route::middleware([CustomCorsMiddleware::class, 'throttle:60,1'])->group(function () {


    Route::get('/departaments', [DepartamentController::class, 'index']);


    Route::get('/departaments/{departmentId}/units', [UnitController::class, 'unitsByDepartment']);

    Route::post('/meetings/store', [MeetingController::class, 'store']);


});

Route::middleware(['auth:sanctum', 'verified', 'throttle:60,1'])->group(function () {

    Route::get('/test-auth', function (Request $request) {
        return response()->json([
            'message' => 'Вы успешно прошли аутентификацию и получили доступ к защищенному маршруту!',
            'user' => $request->user(),
        ]);
    });

});
