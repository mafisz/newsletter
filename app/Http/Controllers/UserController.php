<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Config;
use App\Mail\Test;
use Mail;

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
        $mail_config = Config::get();
        $mail_config = $mail_config->keyBy('key');
        return view('settings', compact('mail_config'));
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

    public function changeSmtp(Request $request)
    {
        $this->validate($request, [
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_name' => 'required',
            'mail_from_address' => 'required'
        ]);

        foreach ($request->except('_token') as $key => $value) {
            if(Config::where('key', $key)->first()){
                $var = Config::where('key', $key)->first();
                $var->value = $value;
                $var->save();
            }
            else{
                $var = new Config();
                $var->key = $key;
                $var->value = $value;
                $var->save(); 
            }
        }

        return redirect()->back()->with('success','Ustawienia zostały zmienione.');
    }

    public function testSmtp(Request $request)
    {
        $this->validate($request, [
            'test_mail' => 'required|email',
        ]);

        try{
            $a = Mail::to($request->test_mail)->send(new Test());
            return redirect()->back()->with('success','Mail został wysłany.');
        }
        catch(\Exception $e){
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
