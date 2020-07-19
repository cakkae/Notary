<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Settings extends Controller
{
    public function index() 
    {
        $settings = \App\Models\UserSettings::where('user_id', Auth::user()->id)->first();
        if(!empty($settings))
            return view('admin.settings.index', ['settings' => $settings]);
        return view('admin.settings.index');
    }

    public function update()
    {
       try {
            $settings = \App\Models\UserSettings::updateOrCreate([
                'user_id' =>  Auth::user()->id
            ],
            [
                'from_email' => request()->from_email,
                'from_name' => request()->from_name,
                'mailer' => request()->mailer,
                'host' => request()->host,
                'port' => request()->port,
                'security_email' => request()->security_email,
                'username' => request()->username,
                'password' => request()->password
            ]
            );
            return response()->json(['success' => 'Your settings are updated.']);
       } catch (Throwable $e) {
            return response()->json(['error'=> $e]);
       }
    }
}
