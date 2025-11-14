<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class UserController extends Controller
{


    public function create()
    {
        return view("user.create");
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'adminCode' => ['required', 'in:alex tro,alextro,aleksey_troitsky,@Aleksey_Troitsky,Aleksey_Troitsky,@aleksey_troitsky,AlexTro,Alex Tro']
        ], [
            'name.required' => 'Без имени - никак',
            'email.required' => 'Без почты - никак',
            'email.email' => 'Это видать не почта...',
            'email.unique' => 'Такая почта уже занята!',
            'password.required' => 'Вы забыли пароль',
            'password.confirmed' => 'Пароли не совпадают.',
            'adminCode.required' => 'Вы не ввели пригласительный код',
            'adminCode.in' => 'Неверный пригласительный код! Уточните у админа.',
        ]);


        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);


        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function login()
    {
        return view("user.login");
    }

    public function loginAuth(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required',],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('userlist')->with('success', 'Добро пожаловайт, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Неверный ящик или пароЛ',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }


    public function forgotPasswordStore(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy(User $user)
    {
        if ($user->email_verified_at !== null) {
            abort(404, 'Can not delete verified user!');
        }

        $user->delete();

        return redirect()->route('userlist')->with('success', 'Пользователь удален!');
    }

    public function verify_manualy(User $user)
    {
        if ($user->email_verified_at !== null) {
            abort(404, 'Can not verify verified user!');
        }
        $user->markEmailAsVerified();


        return redirect()->route('userlist')->with('success', 'Пользователь верифицирован!');
    }


}


