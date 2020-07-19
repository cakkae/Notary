<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Pricing extends Controller
{
    public function index() 
    {
        $pricing = \App\Models\Hardware::where('user_id', Auth::user()->id)->first();
        if(!empty($pricing))
            return view('vendor.pricing.index', ['pricing' => $pricing]);
        return view('vendor.pricing.index');
    }

    public function update()
    {
       try {
            $hardware = \App\Models\Pricing::updateOrCreate([
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
            return response()->json(['success' => 'Your pricing is updated.']);
       } catch (Throwable $e) {
            return response()->json(['error'=> $e]);
       }
    }
}
