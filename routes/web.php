<?php

use App\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::get("/", [
    function () {
        return view("welcome");
    }
])->name("home");

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get("userlist", [ContentController::class, 'userlist'])->name('userlist');

    Route::get('/departaments', [DepartamentController::class, 'index'])->name('departaments.index');
    Route::get('/departaments/{departament}/show', [DepartamentController::class, 'show'])->name('departaments.show');
    Route::get('/departaments/create', [DepartamentController::class, 'create'])->name('departaments.create');  
    Route::post('/departaments', [DepartamentController::class, 'store'])->name('departaments.store'); 
    Route::delete('/departaments/{departament}', [DepartamentController::class, 'destroy'])->name('departaments.destroy');
    
    Route::get('/departaments/{departament}/units', [UnitController::class, 'index'])->name('units.index');  
    Route::get('/departaments/{departament}/units/create', [UnitController::class, 'create'])->name('units.create'); 
    Route::post('/departaments/{departament}/units/store', [UnitController::class, 'store'])->name('units.store');
});




Route::middleware('guest')->group(function () {

    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'loginAuth'])->name('login.auth');

    Route::get('forgot-password', [
        function () {
            return view("user.forgot-password");
        }
    ])->name("password.request");

    Route::post('forgot-password', [UserController::class, 'forgotPasswordStore'])->middleware(['throttle:2,1'])->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('user.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('reset-password', [UserController::class, 'resetPasswordUpdate'])->middleware(['throttle:2,1'])->name('password.update');
});




Route::middleware('auth')->group(function () {
    Route::get('verify-email', function () {
        return view('user.verify-email');
    })->name('verification.notice');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('profile');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Ссылка для подтверждения отправлена на почту!');
    })->middleware(['throttle:2,1'])->name('verification.send');

    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});

