<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function verify($id)
    {
        $usr = User::findOrFail($id);
        $usr->email_verified_at = Carbon::now();
        $usr->save();

        return redirect()->back()->with([
            'f_bg' => 'bg-success',
            'f_title' => 'Account has been verify as administrator.',
            'f_msg' => 'User successfully verified.',
        ]);
    }

    public function destroy($id)
    {
        $usr = User::findOrFail($id);

        if ($usr->delete()){
            return redirect()->route('user.index')->with([
                'f_bg' => 'bg-danger',
                'f_title' => 'User has been destroy from the database.',
                'f_msg' => 'user successfully destroyed.',
            ]);
        }
    }
}
