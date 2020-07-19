<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Request;
use Auth;
use Validator;
use App\User;
use Illuminate\Support\Facades\Response;

class Settings extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Vendor');
    }

    public function index() 
    {
        $user = Auth::user();
        return view('vendor.settings.index', ['user' => $user]);
    }

    public function update()
    {
        $rules = array(
            'name' => 'required|max:255'
        );
        $messages = array(
            'name.required'    => 'Your name is required.',
        );
        $validator = Validator::make(Request::all(), $rules, $messages);
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        } else {
            $user = User::where('id', request('user_id'))->update(request()->except(['_token','user_id']));
            return response()->json(['success'=>'Your profile is updated.']);
        }
    }

}
