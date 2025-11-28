<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {



    Route::get('/test-auth', function (Request $request) {
        return response()->json([
            'message' => 'Вы успешно прошли аутентификацию и получили доступ к защищенному маршруту!',
            'user' => $request->user(),
        ]);
    });



});
