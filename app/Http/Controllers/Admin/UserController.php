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

    public function update(Request $request, $id)
    {
        $usr = User::find($id);

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $usr->name = $request->name;
        $usr->email = $request->email;
        $usr->phone = $request->phone;
        
        $usr->save();
        return redirect()->route('user.index')->with([
            'f_bg' => 'bg-warning',
            'f_title' => 'Data has been update in the database.',
            'f_msg' => 'User successfully updated.',
        ]);
    }

    public function handover(Request $request, $from, $to)
    {
        $from_usr = User::findOrFail($from);
        $to_usr = User::findOrFail($to);

        $from_usr->role = 'sa';
        $to_usr->role = 'manager';
        
        $from_usr->save();
        $to_usr->save();
        return redirect()->route('service.index')->with([
            'f_bg' => 'bg-dark',
            'f_title' => 'Data has been update in the database.',
            'f_msg' => 'Manager status successfully handed over.',
        ]);
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
