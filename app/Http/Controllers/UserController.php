<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function settings()
    {
        return view('settings');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password))
            return redirect()->back()->withInput()->withErrors('Podane hasło jest nieprawidłowe.');
        
        auth()->user()->password = Hash::make($request->password);
        auth()->user()->save();

        return redirect()->back()->with('success','Hasło zostało zmienione.');
    }
}
