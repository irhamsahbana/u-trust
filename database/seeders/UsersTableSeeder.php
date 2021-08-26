<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->role = "manager";
        $user->name = "Irham Sahbana";
        $user->email = "irhamsahbana@gmail.com";
        $user->phone = "082188449289";
        $user->password = Hash::make('flash pro');
        $user->email_verified_at = Carbon::now(); 
        $user->save();
    }
}
