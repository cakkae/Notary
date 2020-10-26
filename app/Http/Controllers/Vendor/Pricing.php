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

    public function update(Request $request)
    {
            $pricing = \App\Models\Pricing::where('user_id', Auth::user()->id)->first();
            if(!empty($pricing)) {
                try {
                    $input = $request->all();
                    $pricing->fill($input)->save();
                    return response()->json(['success'=>'Updated successfully']);
                } catch (Exception $ex) {
                    return response()->json(['error'=>$validator->errors()->all()]);
                }
            }
            else {
                $pricing = new \App\Models\Pricing;
                $pricing->user_id = Auth::user()->id;
                $pricing->deeds = $request->deeds;
                $pricing->trust = $request->trust;
                $pricing->refinance = $request->refinance;
                $pricing->purchase = $request->purchase;
                $pricing->reverse = $request->reverse;
                $pricing->sba = $request->sba;
                $pricing->commercial = $request->commercial;
                $pricing->split_closing = $request->split_closing;
                $pricing->applications = $request->applications;
                $pricing->walk_in_recordings = $request->walk_in_recordings;
                $pricing->monday_from = $request->monday_from;
                $pricing->monday_to = $request->monday_to;
                $pricing->tuesday_from = $request->tuesday_from;
                $pricing->tuesday_to = $request->tuesday_to;
                $pricing->wednesday_from = $request->wednesday_from;
                $pricing->wednesday_to = $request->wednesday_to;
                $pricing->thursday_from = $request->thursday_from;
                $pricing->thursday_to = $request->thursday_to;
                $pricing->friday_to = $request->friday_to;
                $pricing->friday_from = $request->friday_from;
                $pricing->saturday_from = $request->saturday_from;
                $pricing->saturday_to = $request->saturday_to;
                $pricing->sunday_from = $request->sunday_from;
                $pricing->sunday_to = $request->sunday_to;
                $pricing->save();
                return response()->json(['success'=>'Pricing successfully updated.']);
            }
    }
}
