<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Str;
use DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $usr = new User;
        $usr->name = $request->input('name');
        $usr->email = $request->input('email');
        $usr->password = Hash::make($request->input('password'));
        $usr->save();

        return redirect()->route('auth.login')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Your account has been register in the database.',
            'f_msg' => 'wait for another user confirm your account.',
        ]);
    }

    public function authenticate(Request $request)
    {   
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('service.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_send(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|max:255',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if ($user === null) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.mail.forget-password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->route('auth.login')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Your request has been process.',
            'f_msg' => 'we have e-mailed your password reset link.',
        ]);
    }

    public function reset_password($token)
    {
        $token_reset = $token;
        return view('auth.reset-password', compact('token_reset'));
    }

    public function reset_password_send(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                              'email' => $request->email, 
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withErrors([
                'token' => 'The provided credentials token do not match our records.',
            ]);
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect()->route('auth.login')->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Your password has been changed.',
            'f_msg' => 'you can login with the new password.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
