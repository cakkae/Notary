<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Pricing extends Controller
{
    public function index() 
    {
        $pricing = \App\Models\Pricing::where('user_id', Auth::user()->id)->first();
        if(!empty($pricing))
            return view('vendor.pricing.index', ['pricing' => $pricing]);
        return view('vendor.pricing.index');
    }

    public function update()
    {
        try {
            $input = collect(request()->except(['_token']))->filter()->all();
            $pricing = \App\Models\Pricing::where('user_id', request()->user_id)->update($input);
            return response()->json(['success' => 'Pricing successfully updated.']);
        } catch(Throwable $e) {
            return response()->json(['error' => 'Error while updateding price.']);
        }
    }
}
