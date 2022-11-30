<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function addresses()
    {
        $user = auth()->user();
        $users = User::pluck('name','id');
        return view('address.index',compact('users'));
    }

    public function byuser(){
        $user = User::with('addresses')->find(request()->get('user'));
        
        return response()->json($user);
        
    }
}
