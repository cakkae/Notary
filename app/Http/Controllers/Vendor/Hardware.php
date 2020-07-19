<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Hardware extends Controller
{
    public function index() 
    {
        $hardware = \App\Models\Hardware::where('user_id', Auth::user()->id)->first();
        if(!empty($hardware))
            return view('vendor.hardware.index', ['hardware' => $hardware]);
        return view('vendor.hardware.index');
    }

    public function update()
    {
       try {
            $hardware = \App\Models\Hardware::updateOrCreate([
                'user_id' =>  Auth::user()->id
            ],
            [
                'hardware_1' => request()->hardware_1,
                'hardware_2' => request()->hardware_2,
                'hardware_3' => request()->hardware_3,
                'hardware_4' => request()->hardware_4,
                'hardware_5' => request()->hardware_5,
                'hardware_6' => request()->hardware_6,
                'hardware_7' => request()->hardware_7,
                'hardware_8' => request()->hardware_8
            ]
            );
            // ->update(request()->except(['_token', 'user_id']));
            return response()->json(['success' => 'Your profile is updated.']);
       } catch (Throwable $e) {
            return response()->json(['error'=> $e]);
       }
    }
}
